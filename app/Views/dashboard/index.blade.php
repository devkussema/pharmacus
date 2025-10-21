@extends('admin::layout.main')

@section('content')
    <div class="good-morning-blk">
        <div class="row">
            <div class="col-md-6">
                <div class="morning-user">
                    <h2>Bom dia, <span>{{ Auth::user()->nome }}</span></h2>
                    <p>Tenha um bom dia no trabalho</p>
                </div>
            </div>
            <div class="col-md-6 position-blk">
                <div class="morning-img">
                    <img src="{{ assetr('assets/img/morning-img-02.png')}}" alt>
                </div>
            </div>
        </div>
    </div>
@endsection
