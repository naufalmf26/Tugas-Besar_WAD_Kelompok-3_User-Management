<li class="nav-item {{ Nav::isRoute('article.category') }}">
    <a class="nav-link" href="{{ route('article.category') }}">
        <i class="fas fa-fw fa-book"></i>
        <span>{{ __('Article Categories') }}</span>
    </a>
</li>

<li class="nav-item {{ Nav::isRoute('article.index') }}">
    <a class="nav-link" href="{{ route('article.index') }}">
        <i class="fas fa-fw fa-book"></i>
        <span>{{ __('Articles') }}</span>
    </a>
</li>

<li class="nav-item {{ Nav::isRoute('admin.homepage.slider') }}">
    <a class="nav-link" href="{{ route('admin.homepage.slider') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>{{ __('Slide Show') }}</span>
    </a>
</li>

<li class="nav-item {{ Nav::isRoute('admin.homepage.video') }}">
    <a class="nav-link" href="{{ route('admin.homepage.video') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>{{ __('Video') }}</span>
    </a>
</li>

<li class="nav-item {{ Nav::isRoute('admin.member.member') }}">
    <a class="nav-link" href="{{ route('admin.member.member') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>{{ __('Members') }}</span>
    </a>
</li>

<li class="nav-item {{ Nav::isRoute('admin.member.admin') }}">
    <a class="nav-link" href="{{ route('admin.member.admin') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>{{ __('Admins') }}</span>
    </a>
</li>

{{-- <li class="nav-item {{ Nav::isRoute('admin.member.site') }}">
    <a class="nav-link" href="{{ route('admin.member.site') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>{{ __('Sites') }}</span>
    </a>
</li> --}}
