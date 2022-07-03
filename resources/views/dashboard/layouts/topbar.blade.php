<nav class="navbar navbar-expand-md navbar-light py-1">
    <div class="container-fluid">
        <button class="btn btn-default" id="btn-slider" type="button">
            <i class="fa fa-bars fa-lg" aria-hidden="true"></i>
        </button>
        
        <ul class="nav ms-auto">
            <li class="nav-item dropstart">
                <a class="nav-link text-light ps-3 pe-1" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown">
                    {{ auth()->user()->nama }}
                    
                    <!-- <img src="./images/user/user.png" alt="user" class="img-user"> -->
                </a>
                <div class="dropdown-menu mt-2 pt-0" aria-labelledby="navbarDropdown">
                    <div class="d-flex p-3 border-bottom mb-2">
                        <!-- <img src="./images/user/user.png" alt="user" class="img-user me-2"> -->
                        <!-- <div class="d-block">
                            <p class="fw-bold m-0 lh-1">YourName</p>
                        </div>
                    </div> -->
                   
                    <hr class="dropdown-divider">
                    <form action="{{url('logout')}}" method="GET">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout</button>
                      </form> 
                </div>
            </li>
        </ul>
    </div>
</nav>