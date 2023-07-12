        <!--=================================
 header start-->
        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" style="font-style:italic;font-weight:bold; color: green;" href="index.html">School</a>
                <a class="navbar-brand brand-logo-mini" href="index.html"></a>
            </div>


            <!-- Top bar left -->
            <ul class="nav navbar-nav mr-auto">
             
            </ul>

            <!-- top bar right -->

            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item ">
                    <a href="#" class="button-toggle-nav inline-block ml-20 pull-left" data-toggle="dropdown" aria-expanded="false">
                        @if (App::getLocale() == 'en')
                        <span></span>
                        <strong class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                        @else
                        <span></span>
                        <strong class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                        @endif

                    </a>
                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            @if($properties['name'] == "English")
                            <i class="flag-icon flag-icon-us"></i>
                            @elseif($properties['name'] == "Arabic")
                            <i class="flag-icon flag-icon-eg"></i>
                            @endif
                            {{ $properties['native'] }}
                        </a>
                        @endforeach
                    </div>



                </li>
                <li class="nav-item dropdown mr-30">
                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="assets/images/profile-avatar.jpg" alt="avatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-0">{{ Auth::user()->name }}</h5>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
    
                        <a class="dropdown-item" href="#"><i class="text-warning ti-user"></i>Profile</a>
                        @if(auth('student')->check())
                        <a class="dropdown-item" href="{{ route('logout','student') }}"><i class="text-info ti-settings"></i>Logout</a>
                          @elseif(auth('teacher')->check())
                          <a class="dropdown-item" href="{{ route('logout','teacher') }}"><i class="text-info ti-settings"></i>Logout</a>
                          @elseif(auth('parent')->check())
                          <a class="dropdown-item" href="{{ route('logout','parent') }}"><i class="text-info ti-settings"></i>Logout</a>
                          @else
                          <a class="dropdown-item" href="{{ route('logout','admin') }}"><i class="text-info ti-settings"></i>Logout</a>
                          @endif
                          @csrf
                    </div>
                </li>
            </ul>
        </nav>

        <!--=================================
 header End-->