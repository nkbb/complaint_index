<nav id="sidebar"> 
    <ul class="list-unstyled components">
        <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-home"></i> Home</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="#">Home 1</a>
                </li>
                <li>
                    <a href="#">Home 2</a>
                </li>
                <li>
                    <a href="#">Home 3</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">About</a>
        </li>
        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-cog"></i> ตั้งค่า</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="<?=base_url()?>setting/complaint">หลักเกณฑ์การรับเรื่องร้องเรียน</a>
                </li>
                <li>
                    <a href="<?=base_url()?>setting/complaint_type">ประเภทการร้องเรียน</a>
                </li>
                <li>
                    <a href="<?=base_url()?>setting/unit">หน่วย</a>
                </li>
                <li>
                <a href="<?=base_url()?>setting">ข้อมูลพื้นฐาน</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">Portfolio</a>
        </li>
        <li>
            <a href="#">Contact</a>
        </li>
    </ul>
</nav>