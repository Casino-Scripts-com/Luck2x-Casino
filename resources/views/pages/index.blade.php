@extends('layout')

@section('content')
<link rel="stylesheet" href="/css/jackpot.css">
<link rel="stylesheet" href="/css/chief-slider.min.css?v=2">
<link rel="stylesheet" href="/css/slider.css?v=2">
<script type="text/javascript" src="/js/chart.min.js"></script>
<script type="text/javascript" src="/js/chartjs-plugin-labels.js"></script>
<script type="text/javascript" src="/js/jquery.kinetic.min.js"></script>
<script type="text/javascript" src="/js/jackpot.js"></script>
<script type="text/javascript" src="/js/chief-slider.min.js?v=2"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      const slider = new ChiefSlider('.slider', {
        loop: true,
        autoplay: true,
        interval: 5000,
      });
    });
</script>
<style>
    @media(max-width: 992px) {
        .promotion-banner {
            max-height: 120px!important;
        }
    }
</style>
                            <div class="section_Section__14IWw landing_LandingGameSection__JPR73">
                                    <div class="slider promotion-banner">
                                      <div class="slider__container">
                                        <div class="slider__wrapper">
                                          <div class="slider__items">
                                          <div class="slider__item">
                                              <a data-toggle="modal" data-target="#promoModal">
                                                <img src="/img/home/home.jpg?v=1">
                                            </a>
                                            </div>
                                            <div class="slider__item">
                                              <a data-toggle="modal" data-target="#promoModal">
                                                <img src="/img/home/home.jpg?v=1">
                                            </a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <a href="#" class="slider__control" data-slide="prev"></a>
                                      <a href="#" class="slider__control" data-slide="next"></a>
                                      <ol class="slider__indicators">
                                        <li data-slide-to="0" class="active"></li>
                                        <li data-slide-to="1" class=""></li>
                                      </ol>
                                    </div>
                                <div class="games-cards-list">
                                <div class="item">
                                    <a href="/crash" class="game-card">
                                        <div class="card-thumb">
                                            <img draggable="false" src="/img/home/Crash.jpg" alt="">
                                        </div>
                                        <div class="card-name">
                                            Crash<span class="card-cat">multiplayer</span>
                                        </div>
                                    </a>
                                </div> 
                                <div class="item">
                                    <a href="/mines" class="game-card">
                                        <div class="card-thumb">
                                            <img draggable="false" src="/img/home/Mines.jpg" alt="">
                                        </div>
                                        <div class="card-name">
                                            Mines<span class="card-cat">Lucky</span>
                                        </div>
                                    </a>
                                </div>    
                                <div class="item">
                                    <a href="/tower" class="game-card">
                                        <div class="card-thumb">
                                            <img draggable="false" src="/img/home/Tower.jpg" alt="">
                                        </div>
                                        <div class="card-name">
                                            Tower<span class="card-cat">Lucky</span>
                                        </div>
                                    </a>
                                </div>   
                                <div class="item">
                                    <a href="/dice" class="game-card">
                                        <div class="card-thumb">
                                            <img draggable="false" src="/img/home/Dice.jpg" alt="">
                                        </div>
                                        <div class="card-name">
                                            Dice<span class="card-cat">lucky</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="/battle" class="game-card">
                                        <div class="card-thumb">
                                            <img draggable="false" src="/img/home/Battle.jpg" alt="">
                                        </div>
                                        <div class="card-name">
                                            Battle<span class="card-cat">multiplayer</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="/pvp" class="game-card">
                                        <div class="card-thumb">
                                            <img draggable="false" src="/img/home/PvP.jpg" alt="">
                                        </div>
                                        <div class="card-name">
                                            Pvp<span class="card-cat">multiplayer</span>
                                        </div>
                                    </a>
                                </div>     
                                <div class="item">
                                    <a href="/wheel" class="game-card">
                                        <div class="card-thumb">
                                            <img draggable="false" src="/img/home/Wheel.jpg" alt="">
                                        </div>
                                        <div class="card-name">
                                            Roulette<span class="card-cat">multiplayer</span>
                                        </div>
                                    </a>
                                </div>      
                                <div class="item">
                                    <a href="/HiLo" class="game-card">
                                        <div class="card-thumb">
                                            <img draggable="false" src="/img/home/Hilo.jpg" alt="">
                                        </div>
                                        <div class="card-name">
                                            Hilo<span class="card-cat">multiplayer</span>
                                        </div>
                                    </a>
                                </div>                                                                                                                                                                         
                                <div class="item">
                                    <a href="/king" class="game-card">
                                        <div class="card-thumb">
                                            <img draggable="false" src="/img/home/Jackpot.jpg" alt="">
                                        </div>
                                        <div class="card-name">
                                            King<span class="card-cat">LUCKY</span>
                                        </div>
                                    </a>
                                </div>   
                                <div class="item">
                                    <a href="/jackpot" class="game-card">
                                        <div class="card-thumb">
                                            <img draggable="false" src="/img/home/jackpott.jpg" alt="">
                                        </div>
                                        <div class="card-name">
                                            Jackpot<span class="card-cat">multiplayer</span>
                                        </div>
                                    </a>
                                </div>       
                                <div class="item">
                                    <a href="/slots" class="game-card soon">
                                        <div class="card-thumb">
                                            <img draggable="false" src="/img/home/Slots.jpg" alt="">
                                        </div>
                                        <div class="card-name">
                                            Slots<span class="card-cat">soon</span>
                                        </div>
                                    </a>
                                </div>                      
                                <div class="item">
                                    <a href="/" class="game-card soon">
                                        <div class="card-thumb">
                                            <img draggable="false" src="/img/home/live.png" alt="">
                                        </div>
                                        <div class="card-name">
                                            CrazyTime<span class="card-cat">soon</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
@endsection