<template>
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand">
        <img class="c-sidebar-brand-full" src="/assets/brand/coreui-base-white.svg" width="118" height="46" alt="CoreUI Logo">
        <img class="c-sidebar-brand-minimized" src="assets/brand/coreui-signet-white.svg" width="118" height="46" alt="CoreUI Logo">
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use href="assets/coreui.icon.svg#cil-speedometer"></use>
                </svg> Dashboard
                <span class="badge badge-info">NEW</span>
            </a>
        </li>
        <li class="c-sidebar-nav-title">Theme</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/test1">
                <svg class="c-sidebar-nav-icon">
                    <use href="assets/coreui.icon.svg#cil-star"></use>
                </svg> Free Item
            </a>
        </li>
                <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/test2">
                <svg class="c-sidebar-nav-icon">
                    <use href="assets/coreui.icon.svg#cil-fire"></use>
                </svg> Free Item
            </a>
        </li>
        <li class="c-sidebar-nav-title">Components</li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use href="assets/coreui.icon.svg#cil-people"></use>
                </svg> Group
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="/test1">
                        <span class="c-sidebar-nav-icon"></span> Group A
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="#">
                        <span class="c-sidebar-nav-icon"></span> Group B
                    </a>
                </li>
            </ul>
        </li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use href="assets/coreui.icon.svg#cil-snowflake"></use>
                </svg> FreeItem
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="/test2">
                        <span class="c-sidebar-nav-icon"></span> Free Item
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="#">
                        <span class="c-sidebar-nav-icon"></span> Free Item
                    </a>
                </li>
            </ul>
        </li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use href="assets/coreui.icon.svg#cil-paw"></use>
                </svg> FreeItem
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="#">
                        <span class="c-sidebar-nav-icon"></span> Free Item
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="#">
                        <span class="c-sidebar-nav-icon"></span> Free Item
                    </a>
                </li>
            </ul>
        </li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use href="assets/coreui.icon.svg#cil-gem"></use>
                </svg> FreeItem
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="#">
                        <span class="c-sidebar-nav-icon"></span> Free Item
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="#">
                        <span class="c-sidebar-nav-icon"></span> Free Item
                    </a>
                </li>
            </ul>
        </li>
        <li class="c-sidebar-nav-title">Extras</li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use href="assets/coreui.icon.svg#cil-drop"></use>
                </svg> FreeItem
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="#">
                        <span class="c-sidebar-nav-icon"></span> Free Item
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="#">
                        <span class="c-sidebar-nav-icon"></span> Free Item
                    </a>
                </li>
            </ul>
        </li>
        <li class="c-sidebar-nav-item mt-auto">
            <a class="c-sidebar-nav-link c-sidebar-nav-link-success" href="https://coreui.io/demo/3.4.0/icons/coreui-icons-free.html" target="_blank">
                <svg class="c-sidebar-nav-icon">
                    <use href="assets/coreui.icon.svg#cil-sun"></use>
                </svg> Coreui
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link c-sidebar-nav-link-danger" href="#" target="_blank">
                <svg class="c-sidebar-nav-icon">
                    <use href="assets/coreui.icon.svg#cil-heart"></use>
                </svg> Free Item
            </a>
        </li>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
</template>