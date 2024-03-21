@extends('home.index')

@section('titulo', 'Cronologia')

@section('conteudo')
    <style>
        .timeline {
            list-style: none;
            background-image:
            background-repeat: repeat-y;
            background-position: center top;
            padding: 0;
            margin: 2em 0;
            text-align: center
        }

        @media all and (-webkit-min-device-pixel-ratio:1.5),
        all and (-o-min-device-pixel-ratio:3 / 2),
        all and (min--moz-device-pixel-ratio:1.5),
        all and (min-device-pixel-ratio:1.5) {
            .timeline {

                background-size: 2px auto
            }
        }

        .timeline::after {
            display: block;
            clear: both;
            content: ""
        }

        .timeline-marker {
            clear: both;
            background: #fff
        }

        .timeline-marker h1,
        .timeline-marker h2,
        .timeline-marker h3,
        .timeline-marker h4,
        .timeline-marker h5 {
            margin: 0 0 5px
        }

        .timeline-marker:after,
        .timeline-marker:before {
            width: 12px;
            height: 12px;
            background: #1b1b1b;
            margin: 0 auto;
            border-radius: 100%;
            display: block;
            content: ' '
        }

        .timeline-marker:before {
            display: none
        }

        .timeline-marker.timeline-marker-bottom h1,
        .timeline-marker.timeline-marker-bottom h2,
        .timeline-marker.timeline-marker-bottom h3,
        .timeline-marker.timeline-marker-bottom h4,
        .timeline-marker.timeline-marker-bottom h5 {
            margin: 5px 0 0
        }

        .timeline-marker.timeline-marker-bottom:before {
            display: block
        }

        .timeline-marker.timeline-marker-bottom:after {
            display: none
        }

        .timeline-marker.timeline-marker-middle {
            margin-top: 20px;
            margin-bottom: 20px
        }

        .timeline-breaker {
            background: #1b1b1b;
            color: #fff;
            font-weight: 600;
            border-radius: 2px;
            margin: 0 auto;
            text-align: center;
            padding: .6em;
            line-height: 1;
            display: block;
            width: 100%;
            max-width: 15em;
            clear: both
        }

        .timeline-breaker::after {
            display: block;
            clear: both;
            content: ""
        }

        .timeline-breaker a {
            color: #fff
        }

        .timeline-breaker a:hover {
            color: #eee
        }

        .timeline-breaker:after,
        .timeline-breaker:before {
            top: 100%;
            border: solid transparent;
            content: " ";
            height: 1px;
            width: 0;
            position: absolute;
            pointer-events: none
        }

        .timeline-breaker:after {
            border-top-color: #1b1b1b;
            border-width: 10px;
            left: 50%;
            margin-left: -10px
        }

        .timeline-breaker:before {
            border-top-color: rgba(0, 0, 0, .01);
            border-width: 11px;
            left: 50%;
            margin-left: -11px
        }

        .timeline-breaker.timeline-breaker-bottom,
        .timeline-breaker.timeline-breaker-middle {
            margin-top: 40px;
            margin-bottom: 20px;
            clear: both !important
        }

        .timeline-breaker.timeline-breaker-bottom {
            margin-bottom: 0
        }

        .timeline-breaker.timeline-breaker-bottom:after,
        .timeline-breaker.timeline-breaker-bottom:before {
            top: -10px;
            border-top: none
        }

        .timeline-breaker.timeline-breaker-bottom:after {
            border-bottom-color: #1b1b1b
        }

        .timeline-breaker.timeline-breaker-bottom:before {
            border-bottom-color: rgba(0, 0, 0, .01)
        }

        .timeline-item.timeline-item-first {
            margin-top: 20px !important
        }

        .timeline-item.timeline-item-last {
            margin-bottom: 20px !important
        }

        .timeline-item {
            float: none;
            left: auto;
            right: auto;
            width: 100%;
            padding: 15px;
            margin: 60px auto 0;
            background: #f6f6f6;
            border-radius: 2px;
            position: relative;
            border: 1px solid #f2f2f2;
            border-bottom: 3px solid #55A79A;
            text-align: left
        }

        .timeline-item::after {
            display: block;
            clear: both;
            content: ""
        }

        .timeline-item:after,
        .timeline-item:before {
            top: -20px;
            right: 50%;
            left: 50%;
            position: absolute;
            pointer-events: none;
            display: block;
            font-size: 30px;
            height: 30px;
            line-height: 30px;
            width: 30px;
            text-align: center;
            margin-top: 0;
            margin-left: -14px
        }

        .timeline-item:after,
        .timeline-item:before,
        .timeline-stacked-down .timeline-item:before {
            display: inline-block;
            font-weight: 900;
            font-family: 'Font Awesome 5 Free';
            font-style: normal;
            speak: none
        }

        .timeline-item:before {
            content: "\F0D8";
            color: #f6f6f6
        }

        .timeline-item:after {
            content: "\f140";
            top: -39px;
            background: #fff
        }

        .timeline-item.highlight:after,
        .timeline-item.marker-highlight:after,
        .timeline-item.tag-featured:after {
            color: #65b1a5
        }

        .timeline-item.overlap-push-large {
            margin-top: 120px
        }

        .timeline-item.overlap-push-medium {
            margin-top: 60px
        }

        .timeline-item.overlap-push-small {
            margin-top: 30px
        }

        .timeline-stacked-down .timeline-item:first-child {
            margin-top: 40px
        }

        .timeline-stacked-down .timeline-item:last-child {
            margin-bottom: 60px
        }

        .timeline-stacked-down .timeline-item:after,
        .timeline-stacked-down .timeline-item:before {
            bottom: -20px;
            top: auto
        }

        .timeline-stacked-down .timeline-item:before {
            content: "\F0D7"
        }

        .timeline-stacked-down .timeline-item:after {
            bottom: -40px;
            top: auto
        }

        .timeline-item-date {
            font-weight: 600;
            color: #666
        }

        .timeline-item-title {
            margin-top: 0
        }

        @media (min-width:576px) {
            .timeline-breaker.timeline-breaker-bottom,
            .timeline-breaker.timeline-breaker-middle {
                top: 40px
            }
            .timeline-item {
                float: left;
                width: 48%;
                padding: 15px;
                margin-top: 40px;
                right: 30px;
                margin-left: 2%;
                clear: left
            }
            .timeline-item:after,
            .timeline-item:before {
                top: 10%;
                bottom: auto;
                right: -20px;
                left: auto;
                position: absolute;
                pointer-events: none;
                margin: 0;
                display: block;
                font-size: 30px;
                height: 30px;
                line-height: 30px;
                width: 30px;
                text-align: center
            }
            .timeline-item.even:before,
            .timeline-item.right:before,
            .timeline-item:before {
                display: inline-block;
                font-family: 'Font Awesome 5 Free';
                font-weight: 900;
                font-style: normal;
                speak: none
            }
            .timeline-item:before {
                content: "\F0DA"
            }
            .timeline-item:after {
                right: -46px
            }
            .timeline-item.even,
            .timeline-item.right {
                float: right;
                clear: right;
                left: 30px;
                right: 0;
                margin-right: 2%;
                margin-left: 0;
                margin-top: 100px
            }
            .timeline-item.even:after,
            .timeline-item.even:before,
            .timeline-item.right:after,
            .timeline-item.right:before {
                left: -20px;
                top: 10%
            }
            .timeline-item.even:before,
            .timeline-item.right:before {
                content: "\F0D9"
            }
            .timeline-item.even:after,
            .timeline-item.right:after {
                left: -46px
            }
            .timeline-item.overlap-off {
                margin-top: 0
            }
            .timeline-item.overlap-pull-large {
                margin-top: -120px
            }
            .timeline-item.overlap-pull-small {
                margin-top: -30px
            }
            .timeline-stacked,
            .timeline.timeline-stacked {
                padding-left: 0;
                padding-right: 0
            }
            .timeline-stacked .timeline-item,
            .timeline-stacked .timeline-item.even,
            .timeline-stacked .timeline-item.right,
            .timeline.timeline-stacked .timeline-item,
            .timeline.timeline-stacked .timeline-item.even,
            .timeline.timeline-stacked .timeline-item.right {
                float: none;
                left: auto;
                right: auto;
                width: 100%;
                padding: 15px;
                margin: 80px auto 0;
                background: #f6f6f6;
                border-radius: 2px;
                position: relative;
                border: 1px solid #f2f2f2;
                border-bottom: 3px solid #55A79A;
                text-align: left
            }
            .timeline-stacked .timeline-item.even::after,
            .timeline-stacked .timeline-item.right::after,
            .timeline-stacked .timeline-item::after,
            .timeline.timeline-stacked .timeline-item.even::after,
            .timeline.timeline-stacked .timeline-item.right::after,
            .timeline.timeline-stacked .timeline-item::after {
                display: block;
                clear: both;
                content: ""
            }
            .timeline-stacked .timeline-item.even:after,
            .timeline-stacked .timeline-item.even:before,
            .timeline-stacked .timeline-item.right:after,
            .timeline-stacked .timeline-item.right:before,
            .timeline-stacked .timeline-item:after,
            .timeline-stacked .timeline-item:before,
            .timeline.timeline-stacked .timeline-item.even:after,
            .timeline.timeline-stacked .timeline-item.even:before,
            .timeline.timeline-stacked .timeline-item.right:after,
            .timeline.timeline-stacked .timeline-item.right:before,
            .timeline.timeline-stacked .timeline-item:after,
            .timeline.timeline-stacked .timeline-item:before {
                top: -20px;
                right: 50%;
                left: 50%;
                position: absolute;
                pointer-events: none;
                display: block;
                font-size: 30px;
                height: 30px;
                line-height: 30px;
                width: 30px;
                text-align: center;
                margin-top: 0;
                margin-left: -14px
            }
            .timeline-stacked .timeline-item.even:before,
            .timeline-stacked .timeline-item.right:before,
            .timeline-stacked .timeline-item:before,
            .timeline.timeline-stacked .timeline-item.even:before,
            .timeline.timeline-stacked .timeline-item.right:before,
            .timeline.timeline-stacked .timeline-item:before {
                font-family: 'Font Awesome 5 Free';
                font-weight: 900;
                font-style: normal;
                speak: none;
                display: inline-block;
                content: "\F0D8";
                color: #f6f6f6
            }
            .timeline-stacked .timeline-item.even:after,
            .timeline-stacked .timeline-item.right:after,
            .timeline-stacked .timeline-item:after,
            .timeline.timeline-stacked .timeline-item.even:after,
            .timeline.timeline-stacked .timeline-item.right:after,
            .timeline.timeline-stacked .timeline-item:after {
                font-family: 'Font Awesome 5 Free';
                font-weight: 900;
                font-style: normal;
                speak: none;
                display: inline-block;
                content: "\f140";
                top: -39px;
                background: #fff
            }
            .timeline-stacked .timeline-item.even.highlight:after,
            .timeline-stacked .timeline-item.even.marker-highlight:after,
            .timeline-stacked .timeline-item.even.tag-featured:after,
            .timeline-stacked .timeline-item.highlight:after,
            .timeline-stacked .timeline-item.marker-highlight:after,
            .timeline-stacked .timeline-item.right.highlight:after,
            .timeline-stacked .timeline-item.right.marker-highlight:after,
            .timeline-stacked .timeline-item.right.tag-featured:after,
            .timeline-stacked .timeline-item.tag-featured:after,
            .timeline.timeline-stacked .timeline-item.even.highlight:after,
            .timeline.timeline-stacked .timeline-item.even.marker-highlight:after,
            .timeline.timeline-stacked .timeline-item.even.tag-featured:after,
            .timeline.timeline-stacked .timeline-item.highlight:after,
            .timeline.timeline-stacked .timeline-item.marker-highlight:after,
            .timeline.timeline-stacked .timeline-item.right.highlight:after,
            .timeline.timeline-stacked .timeline-item.right.marker-highlight:after,
            .timeline.timeline-stacked .timeline-item.right.tag-featured:after,
            .timeline.timeline-stacked .timeline-item.tag-featured:after {
                color: #65b1a5
            }
            .timeline-stacked .timeline-item.even.overlap-push-large,
            .timeline-stacked .timeline-item.overlap-push-large,
            .timeline-stacked .timeline-item.right.overlap-push-large,
            .timeline.timeline-stacked .timeline-item.even.overlap-push-large,
            .timeline.timeline-stacked .timeline-item.overlap-push-large,
            .timeline.timeline-stacked .timeline-item.right.overlap-push-large {
                margin-top: 120px
            }
            .timeline-stacked .timeline-item.even.overlap-push-medium,
            .timeline-stacked .timeline-item.overlap-push-medium,
            .timeline-stacked .timeline-item.right.overlap-push-medium,
            .timeline.timeline-stacked .timeline-item.even.overlap-push-medium,
            .timeline.timeline-stacked .timeline-item.overlap-push-medium,
            .timeline.timeline-stacked .timeline-item.right.overlap-push-medium {
                margin-top: 60px
            }
            .timeline-stacked .timeline-item.even.overlap-push-small,
            .timeline-stacked .timeline-item.overlap-push-small,
            .timeline-stacked .timeline-item.right.overlap-push-small,
            .timeline.timeline-stacked .timeline-item.even.overlap-push-small,
            .timeline.timeline-stacked .timeline-item.overlap-push-small,
            .timeline.timeline-stacked .timeline-item.right.overlap-push-small {
                margin-top: 30px
            }
            .timeline-stacked.timeline-stacked-down .timeline-item:first-child,
            .timeline.timeline-stacked.timeline-stacked-down .timeline-item:first-child {
                margin-top: 40px
            }
            .timeline-stacked.timeline-stacked-down .timeline-item:last-child,
            .timeline.timeline-stacked.timeline-stacked-down .timeline-item:last-child {
                margin-bottom: 60px
            }
            .timeline-stacked.timeline-stacked-down .timeline-item:after,
            .timeline-stacked.timeline-stacked-down .timeline-item:before,
            .timeline.timeline-stacked.timeline-stacked-down .timeline-item:after,
            .timeline.timeline-stacked.timeline-stacked-down .timeline-item:before {
                bottom: -20px;
                top: auto
            }
            .timeline-stacked.timeline-stacked-down .timeline-item:before,
            .timeline.timeline-stacked.timeline-stacked-down .timeline-item:before {
                font-family: 'Font Awesome 5 Free';
                font-weight: 900;
                font-style: normal;
                speak: none;
                display: inline-block;
                content: "\F0D7"
            }
            .timeline-stacked.timeline-stacked-down .timeline-item:after,
            .timeline.timeline-stacked.timeline-stacked-down .timeline-item:after {
                bottom: -40px;
                top: auto
            }
            .timeline-stacked.timeline-stacked-down .timeline-item.even.last,
            .timeline-stacked.timeline-stacked-down .timeline-item.last,
            .timeline-stacked.timeline-stacked-down .timeline-item.right.last,
            .timeline.timeline-stacked.timeline-stacked-down .timeline-item.even.last,
            .timeline.timeline-stacked.timeline-stacked-down .timeline-item.last,
            .timeline.timeline-stacked.timeline-stacked-down .timeline-item.right.last {
                margin-bottom: 40px
            }
            .timeline-stacked .timeline-breaker.timeline-breaker-bottom,
            .timeline-stacked .timeline-breaker.timeline-breaker-middle,
            .timeline.timeline-stacked .timeline-breaker.timeline-breaker-bottom,
            .timeline.timeline-stacked .timeline-breaker.timeline-breaker-middle {
                top: auto
            }
        }

        .timeline-left,
        .timeline.timeline-left {
            background-position: left top;
            margin-left: 20px;
            padding-bottom: 0;
            text-align: left
        }

        .timeline-left .timeline-marker,
        .timeline.timeline-left .timeline-marker {
            margin-left: -5px;
            margin-right: 0
        }

        .timeline-left .timeline-marker:after,
        .timeline-left .timeline-marker:before,
        .timeline.timeline-left .timeline-marker:after,
        .timeline.timeline-left .timeline-marker:before {
            margin-left: 0
        }

        .timeline-left .timeline-breaker,
        .timeline.timeline-left .timeline-breaker {
            margin-left: -20px
        }

        .timeline-left .timeline-breaker:after,
        .timeline-left .timeline-breaker:before,
        .timeline.timeline-left .timeline-breaker:after,
        .timeline.timeline-left .timeline-breaker:before {
            left: 20px
        }

        .timeline-left .timeline-item,
        .timeline-left .timeline-item.even,
        .timeline-left .timeline-item.right,
        .timeline.timeline-left .timeline-item,
        .timeline.timeline-left .timeline-item.even,
        .timeline.timeline-left .timeline-item.right {
            float: none;
            clear: both;
            width: 92%;
            margin-left: 25px;
            margin-right: 0;
            margin-top: 40px;
            left: auto;
            right: auto
        }

        .timeline-left .timeline-item.even:after,
        .timeline-left .timeline-item.even:before,
        .timeline-left .timeline-item.right:after,
        .timeline-left .timeline-item.right:before,
        .timeline-left .timeline-item:after,
        .timeline-left .timeline-item:before,
        .timeline.timeline-left .timeline-item.even:after,
        .timeline.timeline-left .timeline-item.even:before,
        .timeline.timeline-left .timeline-item.right:after,
        .timeline.timeline-left .timeline-item.right:before,
        .timeline.timeline-left .timeline-item:after,
        .timeline.timeline-left .timeline-item:before {
            right: auto;
            left: -20px;
            margin-left: 0;
            top: 20px
        }

        .timeline-left .timeline-item.even:before,
        .timeline-left .timeline-item.right:before,
        .timeline-left .timeline-item:before,
        .timeline.timeline-left .timeline-item.even:before,
        .timeline.timeline-left .timeline-item.right:before,
        .timeline.timeline-left .timeline-item:before {
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-style: normal;
            speak: none;
            display: inline-block;
            content: "\F0D9"
        }

        .timeline-left .timeline-item.even:after,
        .timeline-left .timeline-item.right:after,
        .timeline-left .timeline-item:after,
        .timeline.timeline-left .timeline-item.even:after,
        .timeline.timeline-left .timeline-item.right:after,
        .timeline.timeline-left .timeline-item:after {
            left: -40px
        }

        .timeline-left .pagination,
        .timeline.timeline-left .pagination {
            background: 0 0;
            padding-left: 1em;
            padding-right: 1em
        }

        .timeline-left .timeline-breaker.timeline-breaker-bottom,
        .timeline-left .timeline-breaker.timeline-breaker-middle,
        .timeline.timeline-left .timeline-breaker.timeline-breaker-bottom,
        .timeline.timeline-left .timeline-breaker.timeline-breaker-middle {
            top: auto;
            margin-bottom: 0
        }

        .timeline-right,
        .timeline.timeline-right {
            background-position: right top;
            margin-right: 20px;
            text-align: right
        }

        .timeline-right .timeline-marker,
        .timeline.timeline-right .timeline-marker {
            margin-left: 0;
            margin-right: -5px;
            float: right
        }

        .timeline-right .timeline-breaker,
        .timeline.timeline-right .timeline-breaker {
            margin-left: 0;
            margin-right: -20px;
            float: right
        }

        .timeline-right .timeline-breaker:after,
        .timeline-right .timeline-breaker:before,
        .timeline.timeline-right .timeline-breaker:after,
        .timeline.timeline-right .timeline-breaker:before {
            right: 12px;
            left: auto
        }

        .timeline-right .timeline-item,
        .timeline-right .timeline-item.even,
        .timeline-right .timeline-item.right,
        .timeline.timeline-right .timeline-item,
        .timeline.timeline-right .timeline-item.even,
        .timeline.timeline-right .timeline-item.right {
            float: right;
            clear: both;
            width: 92%;
            margin-left: 0;
            margin-right: 25px;
            margin-top: 40px;
            left: auto;
            right: 0
        }

        .timeline-right .timeline-item.even:after,
        .timeline-right .timeline-item.even:before,
        .timeline-right .timeline-item.right:after,
        .timeline-right .timeline-item.right:before,
        .timeline-right .timeline-item:after,
        .timeline-right .timeline-item:before,
        .timeline.timeline-right .timeline-item.even:after,
        .timeline.timeline-right .timeline-item.even:before,
        .timeline.timeline-right .timeline-item.right:after,
        .timeline.timeline-right .timeline-item.right:before,
        .timeline.timeline-right .timeline-item:after,
        .timeline.timeline-right .timeline-item:before {
            left: auto;
            right: -20px;
            margin-right: 0;
            top: 20px
        }

        .timeline-right .timeline-item.even:before,
        .timeline-right .timeline-item.right:before,
        .timeline-right .timeline-item:before,
        .timeline.timeline-right .timeline-item.even:before,
        .timeline.timeline-right .timeline-item.right:before,
        .timeline.timeline-right .timeline-item:before {
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-style: normal;
            speak: none;
            display: inline-block;
            content: "\F0DA"
        }

        .timeline-right .timeline-item.even:after,
        .timeline-right .timeline-item.right:after,
        .timeline-right .timeline-item:after,
        .timeline.timeline-right .timeline-item.even:after,
        .timeline.timeline-right .timeline-item.right:after,
        .timeline.timeline-right .timeline-item:after {
            right: -40px;
            left: auto
        }

        .timeline-right .pagination,
        .timeline.timeline-right .pagination {
            background: 0 0;
            padding-left: 1em;
            padding-right: 1em
        }

        .timeline-right .timeline-breaker.timeline-breaker-bottom,
        .timeline-right .timeline-breaker.timeline-breaker-middle,
        .timeline.timeline-right .timeline-breaker.timeline-breaker-bottom,
        .timeline.timeline-right .timeline-breaker.timeline-breaker-middle {
            top: auto;
            margin-bottom: 0
        }

        .timeline-mini .timeline-item {
            padding: .5em !important;
            margin-top: 50px !important
        }

        @media (min-width:576px) {
            .timeline.timeline-left .timeline-item,
            .timeline.timeline-left .timeline-item.even,
            .timeline.timeline-left .timeline-item.right,
            .timeline.timeline-right .timeline-item,
            .timeline.timeline-right .timeline-item.even,
            .timeline.timeline-right .timeline-item.right {
                width: 96%
            }
        }

        .carousel-timeline-nav .owl-nav div {
            margin-top: -2px
        }

        .carousel-timeline-nav .owl-stage-outer {
            padding-bottom: 27px;
            padding-top: 15px;
            margin-bottom: 10px;
            position: relative
        }

        .carousel-timeline-nav .owl-stage-outer:after {
            height: 2px;
            width: 500%;
            background: #292b2c;
            left: -200%;
            right: 0;
            top: auto;
            bottom: 12px;
            position: absolute;
            content: '';
            z-index: -1
        }

        .carousel-timeline-nav.owl-nav-over .owl-stage-outer {
            margin-left: 30px;
            margin-right: 30px
        }

        .carousel-timeline-nav.owl-nav-over-lg .owl-stage-outer {
            margin-left: 60px;
            margin-right: 60px
        }

        .carousel-timeline-nav.owl-nav-over-lg .owl-nav div {
            margin-top: -20px !important
        }

        .carousel-timeline-nav .owl-item {
            text-align: center
        }

        .carousel-timeline-nav .owl-thumb {
            position: relative;
            display: block;
            opacity: .9;
            -webkit-transition: all .3s ease-in;
            transition: all .3s ease-in
        }

        .carousel-timeline-nav .owl-thumb.active {
            opacity: 1
        }

        .carousel-timeline-nav .owl-thumb:before {
            background: #fff;
            left: 0;
            right: 0;
            top: auto;
            position: absolute;
            content: '';
            margin-left: auto;
            margin-right: auto;
            height: 12px;
            width: 12px;
            border-radius: 12px;
            bottom: -20px;
            border: 2px solid #292b2c;
            z-index: 2;
            opacity: 1
        }

        .carousel-timeline-nav .active.owl-thumb:before {
            background: #292b2c
        }

        .list-timeline {
            margin: 0;
            padding: 5px 0;
            position: relative
        }

        .list-timeline:before {
            width: 1px;
            background: #ccc;
            position: absolute;
            left: 6px;
            top: 0;
            bottom: 0;
            height: 100%;
            content: ''
        }

        .list-timeline .list-timeline-item {
            margin: 0;
            padding: 0;
            padding-left: 24px !important;
            position: relative
        }

        .list-timeline .list-timeline-item:before {
            width: 12px;
            height: 12px;
            background: #fff;
            border: 2px solid #ccc;
            position: absolute;
            left: 0;
            top: 4px;
            content: '';
            border-radius: 100%;
            -webkit-transition: all .3 ease-in-out;
            transition: all .3 ease-in-out
        }

        .list-timeline .list-timeline-item[data-toggle=collapse] {
            cursor: pointer
        }

        .list-timeline .list-timeline-item.active:before,
        .list-timeline .list-timeline-item.show:before {
            background: #ccc
        }

        .list-timeline.list-timeline-light .list-timeline-item.active:before,
        .list-timeline.list-timeline-light .list-timeline-item.show:before,
        .list-timeline.list-timeline-light:before {
            background: #f8f9fa
        }

        .list-timeline .list-timeline-item.list-timeline-item-marker-middle:before {
            top: 50%;
            margin-top: -6px
        }

        .list-timeline.list-timeline-light .list-timeline-item:before {
            border-color: #f8f9fa
        }

        .list-timeline.list-timeline-grey .list-timeline-item.active:before,
        .list-timeline.list-timeline-grey .list-timeline-item.show:before,
        .list-timeline.list-timeline-grey:before {
            background: #e9ecef
        }

        .list-timeline.list-timeline-grey .list-timeline-item:before {
            border-color: #e9ecef
        }

        .list-timeline.list-timeline-grey-dark .list-timeline-item.active:before,
        .list-timeline.list-timeline-grey-dark .list-timeline-item.show:before,
        .list-timeline.list-timeline-grey-dark:before {
            background: #495057
        }

        .list-timeline.list-timeline-grey-dark .list-timeline-item:before {
            border-color: #495057
        }

        .list-timeline.list-timeline-primary .list-timeline-item.active:before,
        .list-timeline.list-timeline-primary .list-timeline-item.show:before,
        .list-timeline.list-timeline-primary:before {
            background: #55A79A
        }

        .list-timeline.list-timeline-primary .list-timeline-item:before {
            border-color: #55A79A
        }

        .list-timeline.list-timeline-primary-dark .list-timeline-item.active:before,
        .list-timeline.list-timeline-primary-dark .list-timeline-item.show:before,
        .list-timeline.list-timeline-primary-dark:before {
            background: #33635c
        }

        .list-timeline.list-timeline-primary-dark .list-timeline-item:before {
            border-color: #33635c
        }

        .list-timeline.list-timeline-primary-faded .list-timeline-item.active:before,
        .list-timeline.list-timeline-primary-faded .list-timeline-item.show:before,
        .list-timeline.list-timeline-primary-faded:before {
            background: rgba(85, 167, 154, .3)
        }

        .list-timeline.list-timeline-primary-faded .list-timeline-item:before {
            border-color: rgba(85, 167, 154, .3)
        }

        .list-timeline.list-timeline-info .list-timeline-item.active:before,
        .list-timeline.list-timeline-info .list-timeline-item.show:before,
        .list-timeline.list-timeline-info:before {
            background: #17a2b8
        }

        .list-timeline.list-timeline-info .list-timeline-item:before {
            border-color: #17a2b8
        }

        .list-timeline.list-timeline-success .list-timeline-item.active:before,
        .list-timeline.list-timeline-success .list-timeline-item.show:before,
        .list-timeline.list-timeline-success:before {
            background: #28a745
        }

        .list-timeline.list-timeline-success .list-timeline-item:before {
            border-color: #28a745
        }

        .list-timeline.list-timeline-warning .list-timeline-item.active:before,
        .list-timeline.list-timeline-warning .list-timeline-item.show:before,
        .list-timeline.list-timeline-warning:before {
            background: #ffc107
        }

        .list-timeline.list-timeline-warning .list-timeline-item:before {
            border-color: #ffc107
        }

        .list-timeline.list-timeline-danger .list-timeline-item.active:before,
        .list-timeline.list-timeline-danger .list-timeline-item.show:before,
        .list-timeline.list-timeline-danger:before {
            background: #dc3545
        }

        .list-timeline.list-timeline-danger .list-timeline-item:before {
            border-color: #dc3545
        }

        .list-timeline.list-timeline-dark .list-timeline-item.active:before,
        .list-timeline.list-timeline-dark .list-timeline-item.show:before,
        .list-timeline.list-timeline-dark:before {
            background: #343a40
        }

        .list-timeline.list-timeline-dark .list-timeline-item:before {
            border-color: #343a40
        }

        .list-timeline.list-timeline-secondary .list-timeline-item.active:before,
        .list-timeline.list-timeline-secondary .list-timeline-item.show:before,
        .list-timeline.list-timeline-secondary:before {
            background: #6c757d
        }

        .list-timeline.list-timeline-secondary .list-timeline-item:before {
            border-color: #6c757d
        }

        .list-timeline.list-timeline-black .list-timeline-item.active:before,
        .list-timeline.list-timeline-black .list-timeline-item.show:before,
        .list-timeline.list-timeline-black:before {
            background: #000
        }

        .list-timeline.list-timeline-black .list-timeline-item:before {
            border-color: #000
        }

        .list-timeline.list-timeline-white .list-timeline-item.active:before,
        .list-timeline.list-timeline-white .list-timeline-item.show:before,
        .list-timeline.list-timeline-white:before {
            background: #fff
        }

        .list-timeline.list-timeline-white .list-timeline-item:before {
            border-color: #fff
        }

        .list-timeline.list-timeline-green .list-timeline-item.active:before,
        .list-timeline.list-timeline-green .list-timeline-item.show:before,
        .list-timeline.list-timeline-green:before {
            background: #55A79A
        }

        .list-timeline.list-timeline-green .list-timeline-item:before {
            border-color: #55A79A
        }

        .list-timeline.list-timeline-red .list-timeline-item.active:before,
        .list-timeline.list-timeline-red .list-timeline-item.show:before,
        .list-timeline.list-timeline-red:before {
            background: #BE3E1D
        }

        .list-timeline.list-timeline-red .list-timeline-item:before {
            border-color: #BE3E1D
        }

        .list-timeline.list-timeline-blue .list-timeline-item.active:before,
        .list-timeline.list-timeline-blue .list-timeline-item.show:before,
        .list-timeline.list-timeline-blue:before {
            background: #00ADBB
        }

        .list-timeline.list-timeline-blue .list-timeline-item:before {
            border-color: #00ADBB
        }

        .list-timeline.list-timeline-purple .list-timeline-item.active:before,
        .list-timeline.list-timeline-purple .list-timeline-item.show:before,
        .list-timeline.list-timeline-purple:before {
            background: #b771b0
        }

        .list-timeline.list-timeline-purple .list-timeline-item:before {
            border-color: #b771b0
        }

        .list-timeline.list-timeline-pink .list-timeline-item.active:before,
        .list-timeline.list-timeline-pink .list-timeline-item.show:before,
        .list-timeline.list-timeline-pink:before {
            background: #CC164D
        }

        .list-timeline.list-timeline-pink .list-timeline-item:before {
            border-color: #CC164D
        }

        .list-timeline.list-timeline-orange .list-timeline-item.active:before,
        .list-timeline.list-timeline-orange .list-timeline-item.show:before,
        .list-timeline.list-timeline-orange:before {
            background: #e67e22
        }

        .list-timeline.list-timeline-orange .list-timeline-item:before {
            border-color: #e67e22
        }

        .list-timeline.list-timeline-lime .list-timeline-item.active:before,
        .list-timeline.list-timeline-lime .list-timeline-item.show:before,
        .list-timeline.list-timeline-lime:before {
            background: #b1dc44
        }

        .list-timeline.list-timeline-lime .list-timeline-item:before {
            border-color: #b1dc44
        }

        .list-timeline.list-timeline-blue-dark .list-timeline-item.active:before,
        .list-timeline.list-timeline-blue-dark .list-timeline-item.show:before,
        .list-timeline.list-timeline-blue-dark:before {
            background: #34495e
        }

        .list-timeline.list-timeline-blue-dark .list-timeline-item:before {
            border-color: #34495e
        }

        .list-timeline.list-timeline-red-dark .list-timeline-item.active:before,
        .list-timeline.list-timeline-red-dark .list-timeline-item.show:before,
        .list-timeline.list-timeline-red-dark:before {
            background: #a10f2b
        }

        .list-timeline.list-timeline-red-dark .list-timeline-item:before {
            border-color: #a10f2b
        }

        .list-timeline.list-timeline-brown .list-timeline-item.active:before,
        .list-timeline.list-timeline-brown .list-timeline-item.show:before,
        .list-timeline.list-timeline-brown:before {
            background: #91633c
        }

        .list-timeline.list-timeline-brown .list-timeline-item:before {
            border-color: #91633c
        }

        .list-timeline.list-timeline-cyan-dark .list-timeline-item.active:before,
        .list-timeline.list-timeline-cyan-dark .list-timeline-item.show:before,
        .list-timeline.list-timeline-cyan-dark:before {
            background: #008b8b
        }

        .list-timeline.list-timeline-cyan-dark .list-timeline-item:before {
            border-color: #008b8b
        }

        .list-timeline.list-timeline-yellow .list-timeline-item.active:before,
        .list-timeline.list-timeline-yellow .list-timeline-item.show:before,
        .list-timeline.list-timeline-yellow:before {
            background: #D4AC0D
        }

        .list-timeline.list-timeline-yellow .list-timeline-item:before {
            border-color: #D4AC0D
        }

        .list-timeline.list-timeline-slate .list-timeline-item.active:before,
        .list-timeline.list-timeline-slate .list-timeline-item.show:before,
        .list-timeline.list-timeline-slate:before {
            background: #5D6D7E
        }

        .list-timeline.list-timeline-slate .list-timeline-item:before {
            border-color: #5D6D7E
        }

        .list-timeline.list-timeline-olive .list-timeline-item.active:before,
        .list-timeline.list-timeline-olive .list-timeline-item.show:before,
        .list-timeline.list-timeline-olive:before {
            background: olive
        }

        .list-timeline.list-timeline-olive .list-timeline-item:before {
            border-color: olive
        }

        .list-timeline.list-timeline-teal .list-timeline-item.active:before,
        .list-timeline.list-timeline-teal .list-timeline-item.show:before,
        .list-timeline.list-timeline-teal:before {
            background: teal
        }

        .list-timeline.list-timeline-teal .list-timeline-item:before {
            border-color: teal
        }

        .list-timeline.list-timeline-green-bright .list-timeline-item.active:before,
        .list-timeline.list-timeline-green-bright .list-timeline-item.show:before,
        .list-timeline.list-timeline-green-bright:before {
            background: #2ECC71
        }

        .list-timeline.list-timeline-green-bright .list-timeline-item:before {
            border-color: #2ECC71
        }
    </style>
        <div class="timeline timeline-left mx-lg-10">
            <div class="timeline-breaker">Monday</div>
            <!--Timeline item 1-->
            <div class="timeline-item mt-3 row text-center p-2">
                <div class="col font-weight-bold text-md-right">West Ham</div>
                <div class="col-1">vs</div>
                <div class="col font-weight-bold text-md-left">Chelsea</div>
                <div class="col-12 text-xs text-muted">Football - English Premier League - 19:45 GMT</div>
            </div>
            <!--Timeline item 2 - NOTE: the .right class-->
            <div class="timeline-item mt-3 row text-center p-2">
                <div class="col font-weight-bold text-md-right">Man Utd</div>
                <div class="col-1">vs</div>
                <div class="col font-weight-bold text-md-left">Liverpool</div>
                <div class="col-12 text-xs text-muted">Football - English Premier League - 19:45 GMT</div>
            </div>
            <div class="timeline-breaker timeline-breaker-middle">Tuesday</div>
            <div class="timeline-item mt-3 row text-center p-2">
                <div class="col font-weight-bold text-md-right">England</div>
                <div class="col-1">vs</div>
                <div class="col font-weight-bold text-md-left">India</div>
                <div class="col-12 text-xs text-muted">Cricket - 3rd test - from 10:45 GMT</div>
            </div>
            <div class="timeline-item mt-3 row text-center p-2">
                <div class="col font-weight-bold text-md-right">New Zealand</div>
                <div class="col-1">vs</div>
                <div class="col font-weight-bold text-md-left">South Africa</div>
                <div class="col-12 text-xs text-muted">Cricket - 5th test - from 15:45 GMT</div>
            </div>
            <div class="timeline-item mt-3 row text-center p-2">
                <div class="col font-weight-bold text-md-right">Man Utd</div>
                <div class="col-1">vs</div>
                <div class="col font-weight-bold text-md-left">Liverpool</div>
                <div class="col-12 text-xs text-muted">Football - Europa League - 19:45 GMT</div>
            </div>
            <div class="timeline-breaker timeline-breaker-middle">Saturday</div>
            <div class="timeline-item mt-3 row text-center p-2">
                <div class="col font-weight-bold text-md-right">England</div>
                <div class="col-1">vs</div>
                <div class="col font-weight-bold text-md-left">India</div>
                <div class="col-12 text-xs text-muted">Cricket - 3rd test - from 10:45 GMT</div>
            </div>
            <div class="timeline-item mt-3 row text-center p-2">
                <div class="col font-weight-bold text-md-right">New Zealand</div>
                <div class="col-1">vs</div>
                <div class="col font-weight-bold text-md-left">South Africa</div>
                <div class="col-12 text-xs text-muted">Cricket - 5th test - from 15:45 GMT</div>
            </div>
            <div class="timeline-breaker timeline-breaker-bottom">More next week........</div>
        </div>
@endsection
