@extends('home.index')

@section('titulo', 'Perfil')

@section('conteudo')
    <style type="text/css">
        .apexcharts-canvas {
            position: relative;
            user-select: none;
            /* cannot give overflow: hidden as it will crop tooltips which overflow outside chart area */
        }

        /* scrollbar is not visible by default for legend, hence forcing the visibility */
        .apexcharts-canvas ::-webkit-scrollbar {
            -webkit-appearance: none;
            width: 6px;
        }

        .apexcharts-canvas ::-webkit-scrollbar-thumb {
            border-radius: 4px;
            background-color: rgba(0, 0, 0, .5);
            box-shadow: 0 0 1px rgba(255, 255, 255, .5);
            -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5);
        }

        .apexcharts-canvas.dark {
            background: #343F57;
        }

        .apexcharts-inner {
            position: relative;
        }

        .legend-mouseover-inactive {
            transition: 0.15s ease all;
            opacity: 0.20;
        }

        .apexcharts-series-collapsed {
            opacity: 0;
        }

        .apexcharts-gridline,
        .apexcharts-text {
            pointer-events: none;
        }

        .apexcharts-tooltip {
            border-radius: 5px;
            box-shadow: 2px 2px 6px -4px #999;
            cursor: default;
            font-size: 14px;
            left: 62px;
            opacity: 0;
            pointer-events: none;
            position: absolute;
            top: 20px;
            overflow: hidden;
            white-space: nowrap;
            z-index: 12;
            transition: 0.15s ease all;
        }

        .apexcharts-tooltip.light {
            border: 1px solid #e3e3e3;
            background: rgba(255, 255, 255, 0.96);
        }

        .apexcharts-tooltip.dark {
            color: #fff;
            background: rgba(30, 30, 30, 0.8);
        }

        .apexcharts-tooltip * {
            font-family: inherit;
        }

        .apexcharts-tooltip .apexcharts-marker,
        .apexcharts-area-series .apexcharts-area,
        .apexcharts-line {
            pointer-events: none;
        }

        .apexcharts-tooltip.active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-tooltip-title {
            padding: 6px;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .apexcharts-tooltip.light .apexcharts-tooltip-title {
            background: #ECEFF1;
            border-bottom: 1px solid #ddd;
        }

        .apexcharts-tooltip.dark .apexcharts-tooltip-title {
            background: rgba(0, 0, 0, 0.7);
            border-bottom: 1px solid #333;
        }

        .apexcharts-tooltip-text-value,
        .apexcharts-tooltip-text-z-value {
            display: inline-block;
            font-weight: 600;
            margin-left: 5px;
        }

        .apexcharts-tooltip-text-z-label:empty,
        .apexcharts-tooltip-text-z-value:empty {
            display: none;
        }

        .apexcharts-tooltip-text-value,
        .apexcharts-tooltip-text-z-value {
            font-weight: 600;
        }

        .apexcharts-tooltip-marker {
            width: 12px;
            height: 12px;
            position: relative;
            top: 0px;
            margin-right: 10px;
            border-radius: 50%;
        }

        .apexcharts-tooltip-series-group {
            padding: 0 10px;
            display: none;
            text-align: left;
            justify-content: left;
            align-items: center;
        }

        .apexcharts-tooltip-series-group.active .apexcharts-tooltip-marker {
            opacity: 1;
        }

        .apexcharts-tooltip-series-group.active,
        .apexcharts-tooltip-series-group:last-child {
            padding-bottom: 4px;
        }

        .apexcharts-tooltip-series-group-hidden {
            opacity: 0;
            height: 0;
            line-height: 0;
            padding: 0 !important;
        }

        .apexcharts-tooltip-y-group {
            padding: 6px 0 5px;
        }

        .apexcharts-tooltip-candlestick {
            padding: 4px 8px;
        }

        .apexcharts-tooltip-candlestick>div {
            margin: 4px 0;
        }

        .apexcharts-tooltip-candlestick span.value {
            font-weight: bold;
        }

        .apexcharts-tooltip-rangebar {
            padding: 5px 8px;
        }

        .apexcharts-tooltip-rangebar .category {
            font-weight: 600;
            color: #777;
        }

        .apexcharts-tooltip-rangebar .series-name {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .apexcharts-xaxistooltip {
            opacity: 0;
            padding: 9px 10px;
            pointer-events: none;
            color: #373d3f;
            font-size: 13px;
            text-align: center;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
            background: #ECEFF1;
            border: 1px solid #90A4AE;
            transition: 0.15s ease all;
        }

        .apexcharts-xaxistooltip.dark {
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .apexcharts-xaxistooltip:after,
        .apexcharts-xaxistooltip:before {
            left: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .apexcharts-xaxistooltip:after {
            border-color: rgba(236, 239, 241, 0);
            border-width: 6px;
            margin-left: -6px;
        }

        .apexcharts-xaxistooltip:before {
            border-color: rgba(144, 164, 174, 0);
            border-width: 7px;
            margin-left: -7px;
        }

        .apexcharts-xaxistooltip-bottom:after,
        .apexcharts-xaxistooltip-bottom:before {
            bottom: 100%;
        }

        .apexcharts-xaxistooltip-top:after,
        .apexcharts-xaxistooltip-top:before {
            top: 100%;
        }

        .apexcharts-xaxistooltip-bottom:after {
            border-bottom-color: #ECEFF1;
        }

        .apexcharts-xaxistooltip-bottom:before {
            border-bottom-color: #90A4AE;
        }

        .apexcharts-xaxistooltip-bottom.dark:after {
            border-bottom-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip-bottom.dark:before {
            border-bottom-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip-top:after {
            border-top-color: #ECEFF1
        }

        .apexcharts-xaxistooltip-top:before {
            border-top-color: #90A4AE;
        }

        .apexcharts-xaxistooltip-top.dark:after {
            border-top-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip-top.dark:before {
            border-top-color: rgba(0, 0, 0, 0.5);
        }


        .apexcharts-xaxistooltip.active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-yaxistooltip {
            opacity: 0;
            padding: 4px 10px;
            pointer-events: none;
            color: #373d3f;
            font-size: 13px;
            text-align: center;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
            background: #ECEFF1;
            border: 1px solid #90A4AE;
        }

        .apexcharts-yaxistooltip.dark {
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .apexcharts-yaxistooltip:after,
        .apexcharts-yaxistooltip:before {
            top: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .apexcharts-yaxistooltip:after {
            border-color: rgba(236, 239, 241, 0);
            border-width: 6px;
            margin-top: -6px;
        }

        .apexcharts-yaxistooltip:before {
            border-color: rgba(144, 164, 174, 0);
            border-width: 7px;
            margin-top: -7px;
        }

        .apexcharts-yaxistooltip-left:after,
        .apexcharts-yaxistooltip-left:before {
            left: 100%;
        }

        .apexcharts-yaxistooltip-right:after,
        .apexcharts-yaxistooltip-right:before {
            right: 100%;
        }

        .apexcharts-yaxistooltip-left:after {
            border-left-color: #ECEFF1;
        }

        .apexcharts-yaxistooltip-left:before {
            border-left-color: #90A4AE;
        }

        .apexcharts-yaxistooltip-left.dark:after {
            border-left-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip-left.dark:before {
            border-left-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip-right:after {
            border-right-color: #ECEFF1;
        }

        .apexcharts-yaxistooltip-right:before {
            border-right-color: #90A4AE;
        }

        .apexcharts-yaxistooltip-right.dark:after {
            border-right-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip-right.dark:before {
            border-right-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip.active {
            opacity: 1;
        }

        .apexcharts-yaxistooltip-hidden {
            display: none;
        }

        .apexcharts-xcrosshairs,
        .apexcharts-ycrosshairs {
            pointer-events: none;
            opacity: 0;
            transition: 0.15s ease all;
        }

        .apexcharts-xcrosshairs.active,
        .apexcharts-ycrosshairs.active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-ycrosshairs-hidden {
            opacity: 0;
        }

        .apexcharts-zoom-rect {
            pointer-events: none;
        }

        .apexcharts-selection-rect {
            cursor: move;
        }

        .svg_select_points,
        .svg_select_points_rot {
            opacity: 0;
            visibility: hidden;
        }

        .svg_select_points_l,
        .svg_select_points_r {
            cursor: ew-resize;
            opacity: 1;
            visibility: visible;
            fill: #888;
        }

        .apexcharts-canvas.zoomable .hovering-zoom {
            cursor: crosshair
        }

        .apexcharts-canvas.zoomable .hovering-pan {
            cursor: move
        }

        .apexcharts-xaxis,
        .apexcharts-yaxis {
            pointer-events: none;
        }

        .apexcharts-zoom-icon,
        .apexcharts-zoom-in-icon,
        .apexcharts-zoom-out-icon,
        .apexcharts-reset-zoom-icon,
        .apexcharts-pan-icon,
        .apexcharts-selection-icon,
        .apexcharts-menu-icon,
        .apexcharts-toolbar-custom-icon {
            cursor: pointer;
            width: 20px;
            height: 20px;
            line-height: 24px;
            color: #6E8192;
            text-align: center;
        }


        .apexcharts-zoom-icon svg,
        .apexcharts-zoom-in-icon svg,
        .apexcharts-zoom-out-icon svg,
        .apexcharts-reset-zoom-icon svg,
        .apexcharts-menu-icon svg {
            fill: #6E8192;
        }

        .apexcharts-selection-icon svg {
            fill: #444;
            transform: scale(0.76)
        }

        .dark .apexcharts-zoom-icon svg,
        .dark .apexcharts-zoom-in-icon svg,
        .dark .apexcharts-zoom-out-icon svg,
        .dark .apexcharts-reset-zoom-icon svg,
        .dark .apexcharts-pan-icon svg,
        .dark .apexcharts-selection-icon svg,
        .dark .apexcharts-menu-icon svg,
        .dark .apexcharts-toolbar-custom-icon svg {
            fill: #f3f4f5;
        }

        .apexcharts-canvas .apexcharts-zoom-icon.selected svg,
        .apexcharts-canvas .apexcharts-selection-icon.selected svg,
        .apexcharts-canvas .apexcharts-reset-zoom-icon.selected svg {
            fill: #008FFB;
        }

        .light .apexcharts-selection-icon:not(.selected):hover svg,
        .light .apexcharts-zoom-icon:not(.selected):hover svg,
        .light .apexcharts-zoom-in-icon:hover svg,
        .light .apexcharts-zoom-out-icon:hover svg,
        .light .apexcharts-reset-zoom-icon:hover svg,
        .light .apexcharts-menu-icon:hover svg {
            fill: #333;
        }

        .apexcharts-selection-icon,
        .apexcharts-menu-icon {
            position: relative;
        }

        .apexcharts-reset-zoom-icon {
            margin-left: 5px;
        }

        .apexcharts-zoom-icon,
        .apexcharts-reset-zoom-icon,
        .apexcharts-menu-icon {
            transform: scale(0.85);
        }

        .apexcharts-zoom-in-icon,
        .apexcharts-zoom-out-icon {
            transform: scale(0.7)
        }

        .apexcharts-zoom-out-icon {
            margin-right: 3px;
        }

        .apexcharts-pan-icon {
            transform: scale(0.62);
            position: relative;
            left: 1px;
            top: 0px;
        }

        .apexcharts-pan-icon svg {
            fill: #fff;
            stroke: #6E8192;
            stroke-width: 2;
        }

        .apexcharts-pan-icon.selected svg {
            stroke: #008FFB;
        }

        .apexcharts-pan-icon:not(.selected):hover svg {
            stroke: #333;
        }

        .apexcharts-toolbar {
            position: absolute;
            z-index: 11;
            top: 0px;
            right: 3px;
            max-width: 176px;
            text-align: right;
            border-radius: 3px;
            padding: 0px 6px 2px 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .apexcharts-toolbar svg {
            pointer-events: none;
        }

        .apexcharts-menu {
            background: #fff;
            position: absolute;
            top: 100%;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 3px;
            right: 10px;
            opacity: 0;
            min-width: 110px;
            transition: 0.15s ease all;
            pointer-events: none;
        }

        .apexcharts-menu.open {
            opacity: 1;
            pointer-events: all;
            transition: 0.15s ease all;
        }

        .apexcharts-menu-item {
            padding: 6px 7px;
            font-size: 12px;
            cursor: pointer;
        }

        .light .apexcharts-menu-item:hover {
            background: #eee;
        }

        .dark .apexcharts-menu {
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
        }

        @media screen and (min-width: 768px) {
            .apexcharts-toolbar {
                /*opacity: 0;*/
            }

            .apexcharts-canvas:hover .apexcharts-toolbar {
                opacity: 1;
            }
        }

        .apexcharts-datalabel.hidden {
            opacity: 0;
        }

        .apexcharts-pie-label,
        .apexcharts-datalabel,
        .apexcharts-datalabel-label,
        .apexcharts-datalabel-value {
            cursor: default;
            pointer-events: none;
        }

        .apexcharts-pie-label-delay {
            opacity: 0;
            animation-name: opaque;
            animation-duration: 0.3s;
            animation-fill-mode: forwards;
            animation-timing-function: ease;
        }

        .apexcharts-canvas .hidden {
            opacity: 0;
        }

        .apexcharts-hide .apexcharts-series-points {
            opacity: 0;
        }

        .apexcharts-area-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
        .apexcharts-line-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
        .apexcharts-radar-series path,
        .apexcharts-radar-series polygon {
            pointer-events: none;
        }

        /* markers */

        .apexcharts-marker {
            transition: 0.15s ease all;
        }

        @keyframes opaque {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        /* Resize generated styles */
        @keyframes resizeanim {
            from {
                opacity: 0;
            }

            to {
                opacity: 0;
            }
        }

        .resize-triggers {
            animation: 1ms resizeanim;
            visibility: hidden;
            opacity: 0;
        }

        .resize-triggers,
        .resize-triggers>div,
        .contract-trigger:before {
            content: " ";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        .resize-triggers>div {
            background: #eee;
            overflow: auto;
        }

        .contract-trigger:before {
            width: 200%;
            height: 200%;
        }
    </style>
    <style id="smooth-scrollbar-style">
        [data-scrollbar] {
            display: block;
            position: relative;
        }

        .scroll-content {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .scrollbar-track {
            position: absolute;
            opacity: 0;
            z-index: 1;
            background: rgba(222, 222, 222, .75);
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-transition: opacity 0.5s 0.5s ease-out;
            transition: opacity 0.5s 0.5s ease-out;
        }

        .scrollbar-track.show,
        .scrollbar-track:hover {
            opacity: 1;
            -webkit-transition-delay: 0s;
            transition-delay: 0s;
        }

        .scrollbar-track-x {
            bottom: 0;
            left: 0;
            width: 100%;
            height: 8px;
        }

        .scrollbar-track-y {
            top: 0;
            right: 0;
            width: 8px;
            height: 100%;
        }

        .scrollbar-thumb {
            position: absolute;
            top: 0;
            left: 0;
            width: 8px;
            height: 8px;
            background: rgba(0, 0, 0, .5);
            border-radius: 4px;
        }
    </style>

    <div id="dadoPrincipal">
        <div class="row">
            <div class="col-lg-12">
                <div class="card car-transparent">
                    <div class="card-body p-0">
                        <div class="profile-image position-relative">
                            <img src="{{ asset('assets/images/mountain.png')}}" class="img-fluid rounded w-100"
                                alt="profile-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-sm-0 px-3">
            <div class="col-lg-4 card-profile">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="profile-img position-relative">
                                <img src="{{ asset('assets/images/user/1.png')}}" class="img-fluid rounded avatar-110"
                                    alt="profile-image">
                            </div>
                            <div class="ml-3">
                                <h4 class="mb-1">Ruben Dokidis</h4>
                                <p class="mb-2">UI/UX Designer</p>
                                <a href="#"
                                    class="btn btn-primary font-size-14">Contact</a>
                            </div>
                        </div>
                        <p>
                            I’m a Ux/UI designer. I spend my whole day,
                            practically every day, experimenting with new
                            designs, making illustartion, and animation.
                        </p>
                        <ul class="list-inline p-0 m-0">
                            <li class="mb-2">
                                <div class="d-flex align-items-center">
                                    <svg class="svg-icon mr-3" height="16" width="16"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <p class="mb-0">Calefornia, U.S.A</p>
                                </div>
                            </li>
                            <li class="mb-2">
                                <div class="d-flex align-items-center">
                                    <svg class="svg-icon mr-3" height="16" width="16"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="mb-0">SMCE Corp. Lead UI/UX Designer</p>
                                </div>
                            </li>
                            <li class="mb-2">
                                <div class="d-flex align-items-center">
                                    <svg class="svg-icon mr-3" height="16" width="16"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z">
                                        </path>
                                    </svg>
                                    <p class="mb-0">March 25</p>
                                </div>
                            </li>
                            <li class="mb-2">
                                <div class="d-flex align-items-center">
                                    <svg class="svg-icon mr-3" height="16" width="16"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    <p class="mb-0">+91 01234 56789</p>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center">
                                    <svg class="svg-icon mr-3" height="16" width="16"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="mb-0">JoanDuo@property.com</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 card-profile">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <ul class="d-flex nav nav-pills mb-3 text-center profile-tab" id="profile-pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link show active" data-toggle="pill"
                                    href="#profile1"
                                    role="tab" aria-selected="true">My Skills</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill"
                                    href="#profile2"
                                    role="tab" aria-selected="false">Personal Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill"
                                    href="#profile3"
                                    role="tab" aria-selected="false">Education</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill"
                                    href="#profile4"
                                    role="tab" aria-selected="false">Experience</a>
                            </li>
                            <li class="nav-item">
                                <a id="view-btn" class="nav-link" data-toggle="pill"
                                    href="#profile5"
                                    role="tab" aria-selected="true">About</a>
                            </li>
                        </ul>
                        <div class="profile-content tab-content">

                            <div id="profile1" class="tab-pane fade active show">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Turpis viverra
                                    viverra mollis sed vitae fames
                                    nunc sollicitudin viverra. Curabitur massa, ultrices diam ipsum faucibus
                                    risus. Hendrerit justo,
                                    quis massa a elementum. At elementum.</p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul class="list-inline p-0 m-0">
                                            <li class="mb-4">
                                                <div class="d-flex align-items-center pt-2">
                                                    <img src="./POS Dash _ Perfil_files/01.png" class="img-fluid"
                                                        alt="image">
                                                    <div class="ml-3 w-100">
                                                        <div class="media align-items-center justify-content-between">
                                                            <p class="mb-0">Adobe Photoshop</p>
                                                            <h6>85%</h6>
                                                        </div>
                                                        <div class="iq-progress-bar mt-3">
                                                            <span class="bg-primary iq-progress progress-1"
                                                                data-percent="85"
                                                                style="transition: width 2s ease 0s; width: 85%;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-4">
                                                <div class="d-flex align-items-center pt-2">
                                                    <img src="./POS Dash _ Perfil_files/02.png" class="img-fluid mr-3"
                                                        alt="image">
                                                    <div class="ml-3 w-100">
                                                        <div class="media align-items-center justify-content-between">
                                                            <p class="mb-0">Figma</p>
                                                            <h6>85%</h6>
                                                        </div>
                                                        <div class="iq-progress-bar mt-3">
                                                            <span class="iq-progress iq-progress-danger progress-1"
                                                                data-percent="85"
                                                                style="transition: width 2s ease 0s; width: 85%;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center pt-2">
                                                    <img src="./POS Dash _ Perfil_files/03.png" class="img-fluid"
                                                        alt="image">
                                                    <div class="ml-3 w-100">
                                                        <div class="media align-items-center justify-content-between">
                                                            <p class="mb-0">Adobe Photoshop</p>
                                                            <h6>85%</h6>
                                                        </div>
                                                        <div class="iq-progress-bar mt-3">
                                                            <span class="iq-progress iq-progress-warning progress-1"
                                                                data-percent="85"
                                                                style="transition: width 2s ease 0s; width: 85%;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6">
                                        <ul class="list-inline p-0 m-0">
                                            <li class="mb-4">
                                                <div class="d-flex align-items-center pt-2">
                                                    <img src="./POS Dash _ Perfil_files/04.png" class="img-fluid"
                                                        alt="image">
                                                    <div class="ml-3 w-100">
                                                        <div class="media align-items-center justify-content-between">
                                                            <p class="mb-0">Adobe Photoshop</p>
                                                            <h6>85%</h6>
                                                        </div>
                                                        <div class="iq-progress-bar mt-3">
                                                            <span class="iq-progress iq-progress-success progress-1"
                                                                data-percent="85"
                                                                style="transition: width 2s ease 0s; width: 85%;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-4">
                                                <div class="d-flex align-items-center pt-2">
                                                    <img src="./POS Dash _ Perfil_files/05.png" class="img-fluid"
                                                        alt="image">
                                                    <div class="ml-3 w-100">
                                                        <div class="media align-items-center justify-content-between">
                                                            <p class="mb-0">Figma</p>
                                                            <h6>85%</h6>
                                                        </div>
                                                        <div class="iq-progress-bar mt-3">
                                                            <span class="iq-progress iq-progress-info progress-1"
                                                                data-percent="85"
                                                                style="transition: width 2s ease 0s; width: 85%;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center pt-2">
                                                    <img src="./POS Dash _ Perfil_files/06.png" class="img-fluid"
                                                        alt="image">
                                                    <div class="ml-3 w-100">
                                                        <div class="media align-items-center justify-content-between">
                                                            <p class="mb-0">Adobe Photoshop</p>
                                                            <h6>85%</h6>
                                                        </div>
                                                        <div class="iq-progress-bar mt-3">
                                                            <span class="bg-secondary iq-progress progress-1"
                                                                data-percent="85"
                                                                style="transition: width 2s ease 0s; width: 85%;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="profile2" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card card-block card-stretch mb-0">
                                            <div class="card-header px-4">
                                                <div class="header-title">
                                                    <h4 class="card-title">Personal Skills</h4>
                                                </div>
                                            </div>
                                            <div class="card-body p-4">
                                                <div class="p-2 bg-warning rounded w-100 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <span class="skill-number">1.</span>
                                                        <p class="mb-0">Creative spirit</p>
                                                    </div>
                                                </div>
                                                <div class="p-2 bg-danger rounded w-100 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <span class="skill-number">2.</span>
                                                        <p class="mb-0">Management</p>
                                                    </div>
                                                </div>
                                                <div class="p-2 bg-info rounded w-100 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <span class="skill-number">3.</span>
                                                        <p class="mb-0">Organized</p>
                                                    </div>
                                                </div>
                                                <div class="p-2 bg-success rounded w-100 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <span class="skill-number">4.</span>
                                                        <p class="mb-0">Team Player</p>
                                                    </div>
                                                </div>
                                                <div class="p-2 bg-danger rounded w-100">
                                                    <div class="d-flex align-items-center">
                                                        <span class="skill-number">5.</span>
                                                        <p class="mb-0">Professional</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card card-block card-stretch">
                                            <div class="card-body p-3">
                                                <div class="row align-items-center text-center py-2">
                                                    <div class="profile-info col-xl-3 col-lg-6">
                                                        <div class="profile-icon icon m-auto rounded bg-warning">
                                                            <svg class="svg-icon" width="22" height="22"
                                                                viewBox="0 0 36 48" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M9.10495 33.9964C8.29026 33.1817 8.71495 33.4114 6.74995 32.8855C5.85838 32.6464 5.07463 32.1871 4.36588 31.6367L0.112441 42.0655C-0.299122 43.0752 0.469629 44.1721 1.559 44.1308L6.4987 43.9424L9.8962 47.5311C10.6462 48.3224 11.9624 48.0758 12.374 47.0661L17.2537 35.1017C16.2375 35.668 15.1096 35.9999 13.9434 35.9999C12.1153 35.9999 10.3978 35.2883 9.10495 33.9964V33.9964ZM35.8875 42.0655L31.634 31.6367C30.9253 32.188 30.1415 32.6464 29.25 32.8855C27.2746 33.4142 27.7078 33.1836 26.895 33.9964C25.6021 35.2883 23.8837 35.9999 22.0556 35.9999C20.8893 35.9999 19.7615 35.6671 18.7453 35.1017L23.625 47.0661C24.0365 48.0758 25.3537 48.3224 26.1028 47.5311L29.5012 43.9424L34.4409 44.1308C35.5303 44.1721 36.299 43.0742 35.8875 42.0655V42.0655ZM24.6562 31.8749C26.0887 30.4171 26.2528 30.5427 28.2928 29.9867C29.595 29.6314 30.6131 28.5955 30.9618 27.2699C31.6631 24.6074 31.4812 24.9289 33.3946 22.9808C34.3481 22.0105 34.7203 20.5958 34.3715 19.2702C33.6712 16.6096 33.6703 16.9808 34.3715 14.3174C34.7203 12.9917 34.3481 11.5771 33.3946 10.6067C31.4812 8.65862 31.6631 8.97925 30.9618 6.31768C30.6131 4.99206 29.595 3.95612 28.2928 3.60081C25.679 2.88737 25.994 3.07393 24.0787 1.12487C23.1253 0.154558 21.735 -0.225129 20.4328 0.130183C17.82 0.842683 18.1846 0.843621 15.5671 0.130183C14.2649 -0.225129 12.8746 0.153621 11.9212 1.12487C10.0078 3.073 10.3228 2.88737 7.70807 3.60081C6.40588 3.95612 5.38776 4.99206 5.03901 6.31768C4.33869 8.97925 4.51963 8.65862 2.60619 10.6067C1.65275 11.5771 1.27963 12.9917 1.62932 14.3174C2.32963 16.9761 2.33057 16.6049 1.62932 19.2692C1.28057 20.5949 1.65275 22.0096 2.60619 22.9808C4.51963 24.9289 4.33776 24.6074 5.03901 27.2699C5.38776 28.5955 6.40588 29.6314 7.70807 29.9867C9.8062 30.5586 9.96276 30.4686 11.3437 31.8749C12.584 33.1377 14.5162 33.3636 16.0068 32.4205C16.6029 32.0421 17.2944 31.8411 18.0004 31.8411C18.7065 31.8411 19.3979 32.0421 19.994 32.4205C21.4837 33.3636 23.4159 33.1377 24.6562 31.8749ZM9.15557 16.4961C9.15557 11.5246 13.1156 7.49425 18 7.49425C22.8843 7.49425 26.8443 11.5246 26.8443 16.4961C26.8443 21.4677 22.8843 25.498 18 25.498C13.1156 25.498 9.15557 21.4677 9.15557 16.4961V16.4961Z"
                                                                    fill="#d63a00"></path>
                                                            </svg>
                                                        </div>
                                                        <h5 class="mb-2 mt-3 icon-text-warning">15+</h5>
                                                        <p class="mb-0">Awards</p>
                                                    </div>
                                                    <div class="profile-info col-xl-3 col-lg-6">
                                                        <div class="profile-icon icon m-auto rounded bg-info">
                                                            <svg class="svg-icon" width="22" height="22"
                                                                viewBox="0 0 60 48" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M23.9091 24.5297C24.495 25.1156 25.4447 25.1156 26.0306 24.5297L27.0909 23.4694C27.6769 22.8834 27.6769 21.9338 27.0909 21.3478L23.7422 18L27.09 14.6512C27.6759 14.0653 27.6759 13.1156 27.09 12.5297L26.0297 11.4694C25.4437 10.8834 24.4941 10.8834 23.9081 11.4694L18.4387 16.9387C17.8528 17.5247 17.8528 18.4744 18.4387 19.0603L23.9091 24.5297V24.5297ZM32.91 23.4703L33.9703 24.5306C34.5563 25.1166 35.5059 25.1166 36.0919 24.5306L41.5613 19.0613C42.1472 18.4753 42.1472 17.5256 41.5613 16.9397L36.0919 11.4703C35.5059 10.8844 34.5563 10.8844 33.9703 11.4703L32.91 12.5306C32.3241 13.1166 32.3241 14.0662 32.91 14.6522L36.2578 18L32.91 21.3488C32.3241 21.9347 32.3241 22.8844 32.91 23.4703V23.4703ZM58.5 39H35.7694C35.7 40.8572 34.3903 42 32.7 42H27C25.2478 42 23.9044 40.3622 23.9278 39H1.5C0.675 39 0 39.675 0 40.5V42C0 45.3 2.7 48 6 48H54C57.3 48 60 45.3 60 42V40.5C60 39.675 59.325 39 58.5 39ZM54 4.5C54 2.025 51.975 0 49.5 0H10.5C8.025 0 6 2.025 6 4.5V36H54V4.5ZM48 30H12V6H48V30Z"
                                                                    fill="#32BDEA"></path>
                                                            </svg>
                                                        </div>
                                                        <h5 class="mb-2 mt-3 icon-text-info">35+</h5>
                                                        <p class="mb-0">Certificate</p>
                                                    </div>
                                                    <div class="profile-info col-xl-3 col-lg-6">
                                                        <div class="profile-icon icon m-auto rounded bg-danger">
                                                            <svg class="svg-icon" width="22" height="22"
                                                                viewBox="0 0 48 48" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M35.3676 11.2517C34.8398 11.2372 34.3256 11.3198 33.8438 11.4898V7.03125C33.8438 4.70503 31.9512 2.8125 29.625 2.8125C29.0759 2.8125 28.5517 2.91909 28.0701 3.11072C27.5821 1.32047 25.9428 0 24 0C22.0572 0 20.4179 1.32047 19.9299 3.11072C19.4483 2.91909 18.9241 2.8125 18.375 2.8125C16.0488 2.8125 14.1562 4.70503 14.1562 7.03125V11.4895C13.6747 11.3198 13.1607 11.2372 12.6324 11.2517C10.3711 11.3136 8.53125 13.2316 8.53125 15.5272V48H36.6562V41.2395L38.5637 36.4704C39.1643 34.9689 39.4688 33.3877 39.4688 31.7705V15.5272C39.4688 13.2316 37.6289 11.3136 35.3676 11.2517V11.2517ZM11.3438 45.1875V42.375H33.8438V45.1875H11.3438ZM36.6562 31.7705C36.6562 33.0283 36.4194 34.2581 35.9523 35.4261L34.2979 39.5625H11.3438V15.5272C11.3438 14.7405 11.9564 14.0837 12.7095 14.0631C13.0926 14.0504 13.4561 14.1937 13.7305 14.4607C14.0051 14.7278 14.1563 15.0858 14.1563 15.4687V21.9843H16.9688V7.03125C16.9688 6.25584 17.5997 5.625 18.3751 5.625C19.1505 5.625 19.7813 6.25584 19.7813 7.03125V21.9844H22.5938V4.21875C22.5938 3.44334 23.2247 2.8125 24.0001 2.8125C24.7755 2.8125 25.4063 3.44334 25.4063 4.21875V21.9844H28.2188V7.03125C28.2188 6.25584 28.8497 5.625 29.6251 5.625C30.4005 5.625 31.0313 6.25584 31.0313 7.03125V24.1714C24.712 24.8732 19.7812 30.2467 19.7812 36.75H22.5938C22.5938 31.3222 27.0097 26.9062 32.4375 26.9062H33.8438V15.4688C33.8438 15.0859 33.995 14.7278 34.2696 14.4608C34.544 14.1938 34.9067 14.0508 35.2906 14.0632C36.0436 14.0838 36.6562 14.7406 36.6562 15.5273V31.7705Z"
                                                                    fill="#e83e8c"></path>
                                                            </svg>
                                                        </div>
                                                        <h5 class="mb-2 mt-3 icon-text-danger">04+</h5>
                                                        <p class="mb-0">Experience</p>
                                                    </div>
                                                    <div class="profile-info col-xl-3 col-lg-6">
                                                        <div class="profile-icon icon m-auto rounded bg-success">
                                                            <svg class="svg-icon" width="22" height="22"
                                                                viewBox="0 0 36 48" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M9.10495 33.9964C8.29026 33.1817 8.71495 33.4114 6.74995 32.8855C5.85838 32.6464 5.07463 32.1871 4.36588 31.6367L0.112441 42.0655C-0.299122 43.0752 0.469629 44.1721 1.559 44.1308L6.4987 43.9424L9.8962 47.5311C10.6462 48.3224 11.9624 48.0758 12.374 47.0661L17.2537 35.1017C16.2375 35.668 15.1096 35.9999 13.9434 35.9999C12.1153 35.9999 10.3978 35.2883 9.10495 33.9964V33.9964ZM35.8875 42.0655L31.634 31.6367C30.9253 32.188 30.1415 32.6464 29.25 32.8855C27.2746 33.4142 27.7078 33.1836 26.895 33.9964C25.6021 35.2883 23.8837 35.9999 22.0556 35.9999C20.8893 35.9999 19.7615 35.6671 18.7453 35.1017L23.625 47.0661C24.0365 48.0758 25.3537 48.3224 26.1028 47.5311L29.5012 43.9424L34.4409 44.1308C35.5303 44.1721 36.299 43.0742 35.8875 42.0655V42.0655ZM24.6562 31.8749C26.0887 30.4171 26.2528 30.5427 28.2928 29.9867C29.595 29.6314 30.6131 28.5955 30.9618 27.2699C31.6631 24.6074 31.4812 24.9289 33.3946 22.9808C34.3481 22.0105 34.7203 20.5958 34.3715 19.2702C33.6712 16.6096 33.6703 16.9808 34.3715 14.3174C34.7203 12.9917 34.3481 11.5771 33.3946 10.6067C31.4812 8.65862 31.6631 8.97925 30.9618 6.31768C30.6131 4.99206 29.595 3.95612 28.2928 3.60081C25.679 2.88737 25.994 3.07393 24.0787 1.12487C23.1253 0.154558 21.735 -0.225129 20.4328 0.130183C17.82 0.842683 18.1846 0.843621 15.5671 0.130183C14.2649 -0.225129 12.8746 0.153621 11.9212 1.12487C10.0078 3.073 10.3228 2.88737 7.70807 3.60081C6.40588 3.95612 5.38776 4.99206 5.03901 6.31768C4.33869 8.97925 4.51963 8.65862 2.60619 10.6067C1.65275 11.5771 1.27963 12.9917 1.62932 14.3174C2.32963 16.9761 2.33057 16.6049 1.62932 19.2692C1.28057 20.5949 1.65275 22.0096 2.60619 22.9808C4.51963 24.9289 4.33776 24.6074 5.03901 27.2699C5.38776 28.5955 6.40588 29.6314 7.70807 29.9867C9.8062 30.5586 9.96276 30.4686 11.3437 31.8749C12.584 33.1377 14.5162 33.3636 16.0068 32.4205C16.6029 32.0421 17.2944 31.8411 18.0004 31.8411C18.7065 31.8411 19.3979 32.0421 19.994 32.4205C21.4837 33.3636 23.4159 33.1377 24.6562 31.8749ZM9.15557 16.4961C9.15557 11.5246 13.1156 7.49425 18 7.49425C22.8843 7.49425 26.8443 11.5246 26.8443 16.4961C26.8443 21.4677 22.8843 25.498 18 25.498C13.1156 25.498 9.15557 21.4677 9.15557 16.4961V16.4961Z"
                                                                    fill="#336c47"></path>
                                                            </svg>
                                                        </div>
                                                        <h5 class="mb-2 mt-3 icon-text-success">90+</h5>
                                                        <p class="mb-0">Participated</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-12">
                                                <div class="card card-block card-stretch mb-0">
                                                    <div class="card-header px-3">
                                                        <div class="header-title">
                                                            <h4 class="card-title">Languages</h4>
                                                        </div>
                                                    </div>
                                                    <div class="card-body p-3">
                                                        <ul class="list-inline p-0 mb-0">
                                                            <li>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between mb-2">
                                                                    <p class="mb-0 font-size-16 mr-3">English
                                                                    </p>
                                                                    <h6>78%</h6>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between mb-2">
                                                                    <p class="mb-0">German</p>
                                                                    <h6>55%</h6>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
                                                                    <p class="mb-0">Spanish</p>
                                                                    <h6>50%</h6>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-12">
                                                <div class="card card-block card-stretch mb-0">
                                                    <div class="card-header px-3">
                                                        <div class="header-title">
                                                            <h4 class="card-title">Social</h4>
                                                        </div>
                                                    </div>
                                                    <div class="card-body p-3">
                                                        <ul class="list-inline p-0 m-0">
                                                            <li class="mb-2 d-flex">
                                                                <span><i
                                                                        class="lab la-facebook-f icon-text-primary font-size-20 mr-3"></i></span>
                                                                <p class="mb-0 line-height">fb.me/nataliedawson
                                                                </p>
                                                            </li>
                                                            <li class="mb-2 d-flex">
                                                                <span><i
                                                                        class="lab la-twitter icon-text-info font-size-20 mr-3"></i></span>
                                                                <p class="mb-0 line-height">@nataliedawson</p>
                                                            </li>
                                                            <li class=" d-flex">
                                                                <span><i
                                                                        class="lab la-instagram  icon-text-danger font-size-20 mr-3"></i></span>
                                                                <p class="mb-0 line-height">@natalietweets</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="profile3" class="tab-pane fade">
                                <div
                                    class="profile-line m-0 d-flex align-items-center justify-content-between position-relative">
                                    <ul class="list-inline p-0 m-0 w-100">
                                        <li>
                                            <div class="row align-items-top">
                                                <div class="col-md-3">
                                                    <h6 class="mb-2">October, 2018</h6>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="media profile-media align-items-top">
                                                        <div class="profile-dots border-primary mt-1"></div>
                                                        <div class="ml-4">
                                                            <h6 class=" mb-1">PhD of Science in computer Science
                                                            </h6>
                                                            <p class="mb-0 font-size-14">South Kellergrove
                                                                University</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row align-items-top">
                                                <div class="col-md-3">
                                                    <h6 class="mb-2">June, 2017</h6>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="media profile-media align-items-top">
                                                        <div class="profile-dots border-primary mt-1"></div>
                                                        <div class="ml-4">
                                                            <h6 class=" mb-1">Master of Science in Computer
                                                                Science</h6>
                                                            <p class="mb-0 font-size-14">Milchuer College</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row align-items-top">
                                                <div class="col-md-3">
                                                    <h6 class="mb-2">August, 2014</h6>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="media profile-media align-items-top">
                                                        <div class="profile-dots border-primary mt-1"></div>
                                                        <div class="ml-4">
                                                            <h6 class=" mb-1">Bachelor of Science in Computer
                                                                Science</h6>
                                                            <p class="mb-0 font-size-14">Beechtown Universityy
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row align-items-top">
                                                <div class="col-md-3">
                                                    <h6 class="mb-2">June, 2010</h6>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="media profile-media pb-0 align-items-top">
                                                        <div class="profile-dots border-primary mt-1"></div>
                                                        <div class="ml-4">
                                                            <h6 class=" mb-1">Senior High School</h6>
                                                            <p class="mb-0 font-size-14">South Kellergrove High
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div id="profile4" class="tab-pane fade">
                                <div
                                    class="profile-line m-0 d-flex align-items-center justify-content-between position-relative">
                                    <ul class="list-inline p-0 m-0 w-100">
                                        <li>
                                            <div class="row align-items-top">
                                                <div class="col-md-3">
                                                    <h6 class="mb-2">2020 - present</h6>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="media profile-media align-items-top">
                                                        <div class="profile-dots border-primary mt-1"></div>
                                                        <div class="ml-4">
                                                            <h6 class=" mb-1">Software Engineer at Mathica Labs
                                                            </h6>
                                                            <p class="mb-0 font-size-14">Total : 02 + years of
                                                                experience</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row align-items-top">
                                                <div class="col-md-3">
                                                    <h6 class="mb-2">2018 - 2019</h6>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="media profile-media align-items-top">
                                                        <div class="profile-dots border-primary mt-1"></div>
                                                        <div class="ml-4">
                                                            <h6 class=" mb-1">Junior Software Engineer at
                                                                Zimcore Solutions</h6>
                                                            <p class="mb-0 font-size-14">Total : 1.5 + years of
                                                                experience</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row align-items-top">
                                                <div class="col-md-3">
                                                    <h6 class="mb-2">2017 - 2018</h6>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="media profile-media align-items-top">
                                                        <div class="profile-dots border-primary mt-1"></div>
                                                        <div class="ml-4">
                                                            <h6 class=" mb-1">Junior Software Engineer at
                                                                Skycare Ptv. Ltd</h6>
                                                            <p class="mb-0 font-size-14">Total : 0.5 + years of
                                                                experience</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row align-items-top">
                                                <div class="col-3">
                                                    <h6 class="mb-2">06 Months</h6>
                                                </div>
                                                <div class="col-9">
                                                    <div class="media profile-media pb-0 align-items-top">
                                                        <div class="profile-dots border-primary mt-1"></div>
                                                        <div class="ml-4">
                                                            <h6 class=" mb-1">Junior Software Engineer at
                                                                Infosys Solutions</h6>
                                                            <p class="mb-0 font-size-14">Total : Freshers</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div id="profile5" class="tab-pane fade">
                                <p>I'm Web Developer from California. I code and design websites worldwide.
                                    Mauris variustellus vitae
                                    tristique sagittis. Sed aliquet, est nec auctor aliquet, orci ex vestibulum
                                    ex, non pharetra lacus
                                    erat ac nulla.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis mattis nam
                                    ipsum pharetra porttitor eu
                                    orci, nisi. Magnis elementum vitae eu, dui et. Tempus etiam feugiat sem
                                    augue sed sed. Tristique
                                    feugiat mi feugiat integer consectetur sit enim penatibus. Quis sagittis
                                    proin fermentum tempus
                                    uspendisse ultricies. Tellus sapien, convallis proin pretium.</p>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis
                                    mattis nam ipsum pharetra porttitor eu.
                                    Tristique feugiat mi feugiat integer consectetur sit enim penatibus. Quis
                                    sagittis proin fermentum tempus
                                    uspendisse ultricies. Tellus sapien, convallis proin pretium.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
