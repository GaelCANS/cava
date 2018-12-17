<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-name">
                    <p class="name">
                        @if (auth()->user())
                            {{ auth()->user()->fullname }}
                        @endif
                    </p>
                </div>
            </div>
        </li>


        <li class="nav-item active">
            <a class="nav-link" href="http://localhost:8888/camp/public/dashboard">
                <i class="fas fa-list-alt"></i><br>Enquêtes
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="http://localhost:8888/camp/public/campaigns">
                <i class="fas fa-plus-circle"></i><br>Créer
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="http://localhost:8888/camp/public/cmm">
                <i class="fas fa-wrench"></i><br>Paramètres
            </a>
        </li>
    </ul>
</nav>

