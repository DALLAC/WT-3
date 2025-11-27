import './bootstrap';
import * as bootstrap from 'bootstrap';
import $ from 'jquery';
window.$ = $; 
window.jQuery = $;

function component() {
    const element = document.createElement('div');
    return element;
}

const toastTrigger = document.getElementById('downloadButton')
const toastLiveExample = document.getElementById('liveToast')

if (toastTrigger) {
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
  toastTrigger.addEventListener('click', () => {
    toastBootstrap.show()
  })
}

const bootstrapModal = new bootstrap.Modal(document.getElementById('infoModal'));
const cards = document.querySelectorAll('.pointer-event');
const modal = document.getElementById('infoModal');

const rawData = window.serverStudios || [];

const studiosData = rawData.map(studio => {
    let imagePath = studio.image || '/img/default.png';
    if (!imagePath.startsWith('/') && !imagePath.startsWith('http')) {
        imagePath = '/storage/' + imagePath;
    }

    return {
        title: studio.title,
        image: imagePath,
        fullText: studio.description
    };
});


let currentCardIndex = 0;
let activePopoverInstances = [];

function showCardDetails(index) {
    activePopoverInstances.forEach(popover => popover.dispose());
    const studioData = studiosData[index];

    const modalTitleEl = document.getElementById('infoModalLabel');
    const modalImgEl = document.getElementById('modal-img');
    const modalTextEl = document.getElementById('modal-text');

    modalTitleEl.textContent = studioData.title; 
    modalImgEl.src = studioData.image;
    modalTextEl.innerHTML = studioData.fullText;

    const popoverTriggerList = modal.querySelectorAll('[data-bs-toggle="popover"]');
    
    activePopoverInstances = [...popoverTriggerList].map(popoverTriggerEl => {
        popoverTriggerEl.addEventListener('click', (e) => e.preventDefault());
        return new bootstrap.Popover(popoverTriggerEl);
    });
        
    currentCardIndex = index;
}

cards.forEach((card) => {
        card.addEventListener('click', function(event) {
            if (event.target.tagName === 'A' || event.target.tagName === 'BUTTON') {
                return;
            }

            const indexAttr = this.getAttribute('data-index');
            if (indexAttr !== null) {
                showCardDetails(parseInt(indexAttr));
                bootstrapModal.show();
            }
        });
    });

modal.addEventListener('hidden.bs.modal', event => {
    activePopoverInstances.forEach(popover => popover.dispose());
    activePopoverInstances = [];
});

document.addEventListener('keydown', (event) => {
    if (!modal.classList.contains('show')) {
        return;
    }

    if (event.key === 'ArrowRight') {
        let nextIndex = currentCardIndex + 1;
        if (nextIndex >= cards.length) {
            nextIndex = 0;
        }
        showCardDetails(nextIndex);
    } else if (event.key === 'ArrowLeft') {
        let prevIndex = currentCardIndex - 1;
        if (prevIndex < 0) {
            prevIndex = cards.length - 1;
        }
        showCardDetails(prevIndex);
    } else if (event.key === 'Escape') {
         bootstrapModal.hide();
    }
});

document.body.appendChild(component());