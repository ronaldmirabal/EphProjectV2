@extends('layouts.app')

@section('css')
<style>
.bg-info {
    background-color: #17a2b8!important;
}
.small-box {
    border-radius: 0.25rem;
    box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
    display: block;
    margin-bottom: 20px;
    position: relative;
}
.small-box:hover .icon>i, .small-box:hover .icon>i.fa, .small-box:hover .icon>i.fab, .small-box:hover .icon>i.fad, .small-box:hover .icon>i.fal, .small-box:hover .icon>i.far, .small-box:hover .icon>i.fas, .small-box:hover .icon>i.ion {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
.bg-info, .bg-info>a {
    color: #fff!important;
}
.small-box>.small-box-footer {
    background-color: rgba(0,0,0,.1);
    color: rgba(255,255,255,.8);
    display: block;
    padding: 3px 0;
    position: relative;
    text-align: center;
    text-decoration: none;
    z-index: 10;
}
.small-box>.small-box-footer:hover {
    background-color: rgba(0,0,0,.15);
    color: #fff;
}
.small-box>.inner {
    padding: 10px;
}
.col-lg-3 .small-box h3, .col-md-3 .small-box h3, .col-xl-3 .small-box h3 {
    font-size: 2.2rem;
}
.small-box p {
    z-index: 5;
}
.small-box p {
    font-size: 1rem;
}
.small-box .icon {
    color: rgba(0,0,0,.15);
    z-index: 0;
}
.small-box .icon>i.fa, .small-box .icon>i.fab, .small-box .icon>i.fad, .small-box .icon>i.fal, .small-box .icon>i.far, .small-box .icon>i.fas, .small-box .icon>i.ion {
    font-size: 70px;
    top: 20px;
}
.small-box .icon>i {
    font-size: 90px;
    position: absolute;
    right: 15px;
    top: 15px;
    transition: -webkit-transform .3s linear;
    transition: transform .3s linear;
    transition: transform .3s linear,-webkit-transform .3s linear;
}
.ion-bag:before {
    content: "\f110";
}



</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        
                    @endif
                    @if (Auth::check())
<div class="col-lg-5 col-6">
    <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$inventory}}</h3>
          <p>Registro de Inventario</p>
        </div>
        <div class="icon">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <a href="/inventory" class="small-box-footer">
          Más Info... <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
</div>
                   

                     {{ __('¡Estás conectado!') }}
                    @endif
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
