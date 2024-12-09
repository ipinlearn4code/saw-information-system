<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <!-- Heading Core -->
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="/dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <!-- Heading Interface -->
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseKriteria"
                        aria-expanded="false" aria-controls="collapseKriteria">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Kriteria
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseKriteria" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/kriteria">Daftar Kriteria</a>
                            <a class="nav-link" href="/sub_kriteria">Sub-Kriteria</a>
                        </nav>
                    </div>


                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseKriteria"
                        aria-expanded="false" aria-controls="collapseKriteria">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Penilaian
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseKriteria" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/penilaian">Tabel Penilaian</a>
                            <a class="nav-link" href="/penilaian/normalisasi">Hasil Normalisasi</a>
                            <a class="nav-link" href="/penilaian/hasil-akhir">Hasil Weighting</a>
                        </nav>
                    </div>


                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMahasiswa"
                        aria-expanded="false" aria-controls="collapseMahasiswa">
                        <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                        Alternatif
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseMahasiswa" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/mahasiswa">Data Mahasiswa</a>
                        </nav>
                    </div>
                    <div class="collapse" id="collapseMahasiswa" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/alternatif">Data Alternatif</a>
                        </nav>
                    </div>

                    <!-- Addons Section -->
                    <div class="sb-sidenav-menu-heading">Admin</div>
                    <a class="nav-link" href="/users">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        User Management
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Your Name
            </div>
        </nav>
    </div>

    <!-- Main Content Area -->
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid d-flex justify-content-center" style="max-width: 1200px; ">

                <?= $this->renderSection('content'); ?>

            </div>
        </main>
    </div>
</div>