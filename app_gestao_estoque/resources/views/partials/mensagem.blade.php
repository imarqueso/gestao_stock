
<style>
    .alert-success {
        width: auto;
        height: auto;
        padding: 10px 20px;
        border-radius: 5px;
        color: white;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
        color: white;
        background-color: #056605;
        margin: 20px 0px;
        box-sizing: border-box;
    }

    .alert-danger {
        width: 100%;
        height: auto;
        padding: 10px 20px;
        border-radius: 5px;
        color: white;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
        color: white;
        background-color: #792525;
        margin: 20px 0px;
        box-sizing: border-box;
    }
</style>

@if(session('msg'))
    <div class="alert-success" role="alert">
        {{ session('msg') }}
    </div>
@endif
@if(session('msgf'))
    <div class="alert-danger" role="alert">
        {{ session('msgf') }}
    </div>
@endif
