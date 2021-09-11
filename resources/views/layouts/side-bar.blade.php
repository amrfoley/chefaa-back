<div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
    <h2 class="h2">Dashboard</h2>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{ route('products.index') }}" class="nav-link" aria-current="page">
            <img src="{{ asset('storage/icons/pill.svg') }}" alt="pill-icon" width="24px" />
            Products
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('pharmacies.index') }}" class="nav-link" aria-current="page">
            <img src="{{ asset('storage/icons/pharmacy.svg') }}" alt="pharmacy-icon" width="24px" />
            Pharmacies
        </a>
      </li>
    </ul>
</div>