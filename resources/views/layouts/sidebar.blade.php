<nav class="sidebar ">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      <span style="color:#fbbc06;font-weight:bold">Kisi</span><span style="color: green;font-weight:bold">mani</span>
    </a>
    <div id="close-sidebar" class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  
  <div class="sidebar-body">
    <ul class="nav">
      {{--- admin dashboard ---}}
      <li class="nav-item nav-category">Main</li>
      
      <li class="nav-item {{ active_class(['home']) }}">
        <a href="{{ url('home') }}" class="nav-link">
          <ion-icon class="link-icon" name="home-outline" ></ion-icon>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['reservations']) }}">
        <a href="{{ url('reservations') }}" class="nav-link">
          <ion-icon class="link-icon" name="home-outline" ></ion-icon>
          <span class="link-title">Reservations</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['orders']) }}">
        <a href="{{ url('orders') }}" class="nav-link">
          <ion-icon class="link-icon" name="home-outline" ></ion-icon>
          <span class="link-title">Restaurant Orders</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['drinks-orders']) }}">
        <a href="{{ url('drinks-orders') }}" class="nav-link">
          <ion-icon class="link-icon" name="home-outline" ></ion-icon>
          <span class="link-title">Bar Orders</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['customers']) }}">
        <a href="{{ url('customers') }}" class="nav-link">
          <ion-icon class="link-icon" name="home-outline" ></ion-icon>
          <span class="link-title">Customers</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['rooms']) }}">
        <a href="{{ url('rooms') }}" class="nav-link">
          <ion-icon class="link-icon" name="home-outline" ></ion-icon>
          <span class="link-title">Rooms</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['room-types']) }}">
        <a href="{{ url('room-types') }}" class="nav-link">
          <ion-icon class="link-icon" name="home-outline" ></ion-icon>
          <span class="link-title">Room Types</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['items']) }}">
        <a href="{{ url('items') }}" class="nav-link">
          <ion-icon class="link-icon" name="home-outline" ></ion-icon>
          <span class="link-title">Food Items</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['drinks']) }}">
        <a href="{{ url('drinks') }}" class="nav-link">
          <ion-icon class="link-icon" name="home-outline" ></ion-icon>
          <span class="link-title">Bar Items</span>
        </a>
      </li>


      <li class="nav-item {{ active_class(['users']) }}">
        <a href="{{ url('users') }}" class="nav-link">
          <ion-icon class="link-icon" name="home-outline" ></ion-icon>
          <span class="link-title">Users</span>
        </a>
      </li>
      
    </ul>
  </div>
</nav>