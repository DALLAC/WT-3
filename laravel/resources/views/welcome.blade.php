<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Rockstar Games</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://unpkg.com/lodash@4.17.20"></script>
  </head>
  <body>
    <nav class="navbar navbar-custom py-0">
        <div class="container-fluid container-custom h-100 px-0">
            <a class="navbar-brand d-flex align-items-start h-100 text-decoration-none p-0" href="#">
                <div class="hlabel">d</div>
                <div class="hname">
                    <h3>Rockstar Games</h3>
                </div>
            </a>
        
            <div class="hbutton">
                <button type="button" class="btn btn-primary" id="downloadButton">Загрузить</button>
                 <a href="{{ route('studios.create') }}" class="btn btn-success btn-sm">Добавить</a>
            </div>
        </div>
    </nav>

    <div class="container">
      <h1>Лабораторная 3</h1>
      <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-3 row-cols-wide-4 ">
          @foreach($studios as $index => $studio)
    
            <div class="col mb-4">
                <div class="card h-100">
                    <a href="{{ route('studios.show', $studio->id) }}" class="text-decoration-none text-dark h-100 d-block">
                        <div class="pointer-event h-100" data-index="{{ $index }}">
                            
                            <div class="labelImg">
                                <img src="{{ $studio->image ? (Str::startsWith($studio->image, '/') ? $studio->image : asset('storage/' . $studio->image)) : '/img/default.png' }}" 
                                    class="card-img-top" 
                                    alt="{{ $studio->title }}">
                                <div class="label">{{ $studio->location }}</div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title">{{ $studio->title }}</h3>
                                <p class="card-text">{{ $studio->short_description }}</p>
                            </div>
                            
                        </div>      
                    </a>

                    <div class="card-footer bg-transparent d-flex justify-content-between">
                        <a href="{{ route('studios.edit', $studio->id) }}" class="btn btn-sm btn-action edit-btn">
                            Ред.
                        </a>

                        <a href="{{ route('studios.show', $studio->id) }}" class="btn btn-sm btn-action" title="Открыть отдельную страницу">
                            Инфо
                        </a>

                        <form action="{{ route('studios.destroy', $studio->id) }}" method="POST" onsubmit="return confirm('Удалить?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-action delete-btn">Удалить</button>
                        </form>
                    </div>

                </div>
            </div>


            @endforeach
      </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <i class="fas fa-download fa-spin me-2"></i>
          <strong class="me-auto">Загрузка</strong>
          <small></small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          На текущий момент этот функционал недоступен!
        </div>
      </div>
    </div>

   <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img id="modal-img" src="" alt="Логотип студии" class="img-fluid modal-img-custom">
                </div>
                <p id="modal-text"></p>
            </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="fcontent">
            <div class="fname">
            </div>
            <div class="freferences">
                <a href="https://ya.ru/" class="round-btn">
                    <img src="/img/telegram.png" alt="tg" class="btnIco">
                </a>
                <a href="https://ya.ru/" class="round-btn">
                    <img src="/img/vk.png" alt="vk" class=" btnIco">
                </a>
                <a href="https://ya.ru/" class="round-btn">
                    <img src="/img/ya_messenger.png" alt="ya" class="btnIco">
                </a>
            </div>
        </div>
    </footer>

    
    <script>
    window.serverStudios = @json($studios);
    </script>
  </body>


</html>