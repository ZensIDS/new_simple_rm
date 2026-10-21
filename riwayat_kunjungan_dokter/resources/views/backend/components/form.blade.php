<div class="card">
    <div class="card-header">
        <div class="card-title">
            {{ $title }}
        </div>
    </div>
    <div class="card-body">
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
        {{ $form }}
    </div>
    <div class="card-footer text-right">
        <a href="{{ $routeBack }}" class="btn btn-secondary btn-sm btn-flat">Batal</a>
        <button class="btn btn-success btn-sm btn-flat">Simpan</button>
    </form>
    </div>
</div>