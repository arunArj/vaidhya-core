<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
<div class="sidebar-header">
<img src="{{asset('assets/images/logo.svg')}}" alt="" srcset="">
</div>
<div class="sidebar-menu">
<ul class="menu">


        <li class='sidebar-title'>Main Menu</li>



        <li class="sidebar-item  ">

            <a href="/dashboard" class='sidebar-link'>
                <i data-feather="home" width="20"></i>
                <span>Dashboard</span>
            </a>


        </li>

        {{-- <li class="sidebar-item ">

            <a href="/patients" class='sidebar-link'>
                <i data-feather="home" width="20"></i>
                <span>Patients</span>
            </a>


        </li> --}}


        <li class="sidebar-item active  has-sub">

            <a href="#" class='sidebar-link'>
                <i data-feather="archive" width="20"></i>
                <span>Inventory</span>
            </a>


            <ul class="submenu">
                <li>
                    <a href="/suppliers" class="active">Suppliers</a>
                </li>
                <li>
                    <a href="/medicines">Medicines</a>
                </li>

                <li>
                    <a href="/purchase">Purchase Order</a>
                </li>

                <li>
                    <a href="/inventory">Inventory</a>
                </li>



            </ul>

        </li>

</ul>
</div>
<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
</div>
