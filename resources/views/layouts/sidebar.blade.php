

<nav class="sidebar ">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      <span style="color:#fbbc06;font-weight:bold">Bot</span><span style="color: green;font-weight:bold">Builder</span>
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

      <li class="nav-item {{ active_class(['bots']) }} {{ active_class(['bots/workflow/*']) }}">
        <a href="{{ url('bots') }}" class="nav-link">
          <ion-icon class="link-icon" name="home-outline" ></ion-icon>
          <span class="link-title">Bots</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['bots']) }}">
        <a href="{{ route('get.conversations') }}" class="nav-link">
          <ion-icon class="link-icon" name="home-outline" ></ion-icon>
          <span class="link-title">Conversations</span>
        </a>
      </li>
      
    </ul>
  </div>
</nav>