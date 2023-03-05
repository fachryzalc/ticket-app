@extends('welcome')

@section('content')
    <div class="container">
        <h1 class="upcomming">Upcoming Event</h1>
        @if ($tickets)
            <?php 
              foreach($tickets as $ticket){
             ?>
            <div class="item">
                <div class="item-right">
                    <h2 class="num">{{ date('d', strtotime($ticket->date)) }}</h2>
                    <p class="day">{{ date('M', strtotime($ticket->date)) }}</p>
                    <span class="up-border"></span>
                    <span class="down-border"></span>
                </div> <!-- end item-right -->

                <div class="item-left">
                    <span class="event">
                        @if ($ticket->discount > 0)
                            {{ ($ticket->discount / $ticket->price) * 100 }}%
                        @else
                        @endif
                    </span>
                    <h2 class="title">{{ $ticket->name }}</h2>

                    <div class="sce">
                        <p>{{ date('l', strtotime($ticket->date)) }} <br />
                            {{ date('d F Y', strtotime($ticket->date)) }}
                        </p>
                    </div>
                    <div class="fix"></div>
                    <div class="loc">
                        <p @if ($ticket->discount > 0) style="text-decoration: line-through;color:red;" @endif>Rp.
                            {{ number_format($ticket->price, 2, ',', '.') }}</p>
                        @if ($ticket->discount > 0)
                            <p>
                                Rp. {{ number_format($ticket->discount, 2, ',', '.') }}
                            </p>
                        @endif
                        <p>
                            Stock : {{ $ticket->stock }}
                        </p>

                    </div>
                    <div class="fix"></div>
                    <a class="tickets" href="/addtocart/{{ $ticket->id }}">Order</a>
                </div> <!-- end item-right -->
            </div> <!-- end item -->
            <?php } ?>
        @endif
        <h1 class="upcomming">Expired Event</h1>
        @if ($expireds)
            <?php 
              foreach($expireds as $expired){
             ?>
            <div class="item">
                <div class="item-right">
                    <p class="day">{{ date('l', strtotime($expired->date)) }}</p>
                    <h2 class="num">{{ date('d', strtotime($expired->date)) }}</h2>
                    <p class="day">{{ date('M', strtotime($expired->date)) }}</p>
                    <span class="up-border"></span>
                    <span class="down-border"></span>
                </div> <!-- end item-right -->

                <div class="item-left">
                    <span class="event">
                        @if ($expired->discount > 0)
                            {{ ($expired->discount / $expired->price) * 100 }}%
                        @else
                        @endif
                    </span>
                    <h2 class="title">{{ $expired->name }}</h2>

                    <div class="sce">
                        <p>
                            {{-- {{ date('d F Y', strtotime($expired->date)) }} --}}
                            Due Date : {{ date('d F Y', strtotime($expired->duedate)) }}
                        </p>
                    </div>
                    <div class="fix"></div>
                    <div class="loc">
                        <p @if ($expired->discount > 0) style="text-decoration: line-through;color:red;" @endif>Rp.
                            {{ number_format($expired->price, 2, ',', '.') }}</p>
                        @if ($expired->discount > 0)
                            <p>
                                Rp. {{ number_format($expired->discount, 2, ',', '.') }}
                            </p>
                        @endif
                        <p>
                            Stock : {{ $expired->stock }}
                        </p>

                    </div>
                    <div class="fix"></div>
                    <a class="tickets" href="#">{{ $expired->stock == 0 ? 'SOLD' : 'CLOSED' }}</a>
                </div> <!-- end item-right -->
            </div> <!-- end item -->
            <?php } ?>
        @endif
    </div>
@endsection
