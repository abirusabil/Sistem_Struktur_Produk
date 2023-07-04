<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/Purchase_Order">Aneka Regalindo</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/Purchase_Order">AR</a>
        </div>
        <ul class="sidebar-menu">

            {{-- Purchase Order --}}
            <li class="menu-header">Purchase Order</li>
            <li class="nav-item dropdown {{ $type_menu === 'PurchaseOrder' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-clipboard-list"></i><span>Purchase Order</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('Purchase_Order','Purchase_Order/*','Kebutuhan_Kayu/*/edit','Kebutuhan_Plywood_MDF/*/edit','Kebutuhan_Accessories_Hardware/*/edit','Kebutuhan_Komponen_Finishing/*/edit','Kebutuhan_Pendukung_Packing/*/edit','Kebutuhan_Karton_Box/*/edit','Borongan_Dalam_Po/*/edit','Borongan_Luar_Po/*/edit') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('/Purchase_Order') }}"># List Purchase Order</a>
                    </li>
                    @if(in_array(auth()->user()->akses , [1,2]))
                    <li class="{{ Request::is('Purchase_Order/create') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('Purchase_Order/create') }}"># Tambah Purchase Order</a>
                    </li>
                    @endif
                </ul>
            </li>
            {{--end Purchase Order --}}

            {{-- Data Barang --}}
            <li class="menu-header">Data Barang</li>
            <li class="nav-item dropdown {{ $type_menu === 'Item' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="fas fa-solid fa-couch"></i><span>Item</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('Item','Item/*') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('/Item') }}"># List item</a>
                    </li>
                    @if(in_array(auth()->user()->akses , [1,2]))
                    <li class="{{ Request::is('Item/create') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('/Item/create') }}"># Tambah Item</a>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'Collection' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Collection</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('Collection') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('/Collection') }}"># List Collection</a>
                    </li>
                    @if(in_array(auth()->user()->akses , [1,2]))
                    <li class="{{ Request::is('Collection/create') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('Collection/create') }}"># Tambah Collection</a>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'Buyer' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="fas fa-solid fa-users-between-lines"></i></i> <span>Buyer</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('Buyer') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('/Buyer') }}"># List Buyer</a>
                    </li>
                    @if(in_array(auth()->user()->akses , [1,2]))
                    <li class="{{ Request::is('transparent-sidebar') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('/Buyer/create') }}"># Tambah Buyer</a>
                    </li>
                    @endif
                </ul>
            </li>

            {{-- end Data Barang --}}

            {{-- Data Materials --}}
            <li class="menu-header">Data Materials</li>

                {{-- Kayu --}}
                <li class="nav-item dropdown {{ $type_menu === 'Kayu' ? 'active' : '' }}">
                    <a href="#"
                        class="nav-link has-dropdown"
                        data-toggle="dropdown"><i class="fas fa-solid fa-tree"></i><span>Kayu</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('Kayu') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Kayu') }}"># List Kayu</a>
                        </li>
                        @if(in_array(auth()->user()->akses , [1,2]))
                        <li class="{{ Request::is('Kayu/create') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Kayu/create') }}"># Tambah Kayu</a>
                        </li>
                        @endif
                        <li class="{{ Request::is('Kebutuhan_Kayu') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Kebutuhan_Kayu') }}"># List Kebutuhan Kayu</a>
                        </li>
                    </ul>
                </li>
                {{-- End Kayu --}}

                {{-- Plywood MDF --}}
                <li class="nav-item dropdown {{ $type_menu === 'Plywood_MDF' ? 'active' : '' }}">
                    <a href="#"
                        class="nav-link has-dropdown"
                        data-toggle="dropdown"><i class="fas fa-solid fa-layer-group"></i><span>Plywood Dan Mdf</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('Plywood_MDF') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Plywood_MDF') }}"># List Plywood Dan Mdf</a>
                        </li>
                        @if(in_array(auth()->user()->akses , [1,2]))
                        <li class="{{ Request::is('Plywood_MDF/create') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Plywood_MDF/create') }}"># Tambah Plywood Dan Mdf </a>
                        </li>
                        @endif
                        <li class="{{ Request::is('Kebutuhan_Plywood_MDF') ? 'active' : '' }} ">
                            <a class="nav-link"
                                href="{{ url('/Kebutuhan_Plywood_MDF') }}"># List Kebutuhan Plywood Dan Mdf</a>
                        </li>
                    </ul>
                </li>
                {{-- End Plywood MDF --}}

                {{-- Accessories & Hardware --}}
                <li class="nav-item dropdown {{ $type_menu === 'Accessories_Hardware' ? 'active' : '' }}">
                    <a href="#"
                        class="nav-link has-dropdown"
                        data-toggle="dropdown"><i class="fas fa-solid fa-wrench"></i></i> <span>Accessories & Hardware</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('Accessories_Hardware') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Accessories_Hardware') }}"># List Accessories & Hardware</a>
                        </li>
                        @if(in_array(auth()->user()->akses , [1,2]))
                        <li class="{{ Request::is('Accessories_Hardware/create') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Accessories_Hardware/create') }}"># Tambah Accessories & Hardware</a>
                        </li>
                        @endif
                        <li class="{{ Request::is('Kebutuhan_Accessories_Hardware') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Kebutuhan_Accessories_Hardware') }}"># List Kebutuhan Accessories & Hardware</a>
                        </li>
                    </ul>
                </li>
                {{-- End Accessories & Hardware  --}}

                {{-- Komponen Finishing --}}
                <li class="nav-item dropdown {{ $type_menu === 'Komponen_Finishing' ? 'active' : '' }}">
                    <a href="#"
                        class="nav-link has-dropdown"
                        data-toggle="dropdown"><i class="fas fa-regular fa-brush"></i><span>Komponen Finishing</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('Komponen_Finishing') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Komponen_Finishing') }}"># List Komponen Finishing</a>
                        </li>
                        @if(in_array(auth()->user()->akses , [1,2]))
                        <li class="{{ Request::is('Komponen_Finishing/create') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Komponen_Finishing/create') }}"># Tambah Komponen Finishing</a>
                        </li>
                        @endif
                        <li class="{{ Request::is('Kebutuhan_Komponen_Finishing') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Kebutuhan_Komponen_Finishing') }}"># List Kebutuhan Komponen Finishing</a>
                        </li>
                    </ul>
                </li>
                {{-- End Komponen Finishing --}}

                

                {{-- Pendukung Packing --}}
                <li class="nav-item dropdown {{ $type_menu === 'Pendukung_Packing' ? 'active' : '' }}">
                    <a href="#"
                        class="nav-link has-dropdown"
                        data-toggle="dropdown"><i class="fas fa-solid fa-boxes-stacked"></i><span>Pendukung Packing</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('Pendukung_Packing') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Pendukung_Packing') }}"># List Pendukung Packing</a>
                        </li>
                        @if(in_array(auth()->user()->akses , [1,2]))
                        <li class="{{ Request::is('Pendukung_Packing/create') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Pendukung_Packing/create') }}"># Tambah Pendukung Packing</a>
                        </li>
                        @endif
                        <li class="{{ Request::is('Kebutuhan_Pendukung_Packing') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Kebutuhan_Pendukung_Packing') }}"># List Kebutuhan Pendukung Packing</a>
                        </li>
                    </ul>
                </li>
                {{-- List Pendukung Packing --}}

                {{-- Karton Box --}}
                
                
                <li class="nav-item dropdown {{ $type_menu === 'Karton_Box' ? 'active' : '' }}">
                    <a href="#"
                        class="nav-link has-dropdown"
                        data-toggle="dropdown"><i class="fas fa-solid fa-box-open"></i><span>Karton Box</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('Kebutuhan_Karton_Box') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ url('/Kebutuhan_Karton_Box') }}"># List Kebutuhan Karton Box</a>
                        </li>
                    </ul>
                </li>
                
                {{-- List Karton Box --}}

            {{-- end Data Materials --}}

            {{-- Pembelian --}}
            <li class="menu-header">Pembelian</li>
            <li class="nav-item dropdown {{ $type_menu === 'Suplier' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-solid fa-truck-field"></i></i><span>Suplier</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('Suplier') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('/Suplier') }}"># List Suplier</a>
                    </li>
                    @if(in_array(auth()->user()->akses , [1,2]))
                    <li class="{{ Request::is('Suplier/create') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('/Suplier/create') }}"># Tambah Suplier</a>
                    </li>
                    @endif
                </ul>
            </li>
            {{--end Pembelian --}}

            {{-- Pembelian --}}
            @if(in_array(auth()->user()->akses , [1]))
            <li class="menu-header">User</li>
            <li class="nav-item dropdown {{ $type_menu === 'User' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-solid fa-user"></i><span>User</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('User') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('/User') }}"># List User</a>
                    </li>
                    <li class="{{ Request::is('User/create') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('/User/create') }}"># Tambah User</a>
                    </li>
                </ul>
            </li>
           @endif
            {{--end Pembelian --}}
      
    </aside>
</div>
