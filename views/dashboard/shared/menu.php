<aside class="col-lg-2 col-md-3 sidebar">
    <div class="header-menu">        
       
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo $url ?>/logoutAdmin"> 
                    <i class="fas fa-walking"></i>
                    Sair
                </a>
            </div>
        </div>

    </div>

    <div class="sidebar-links">
        <ul>
            <li>
                <a href="<?php echo $url; ?>/dashboard" class="<?php echo (end($params) == 'dashboard') ? 'active' : '';?>">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?php echo $url; ?>/dashboard/donor" class="<?php echo (end($params) == 'donor') ? 'active' : '';?>">
                    <i class="fas fa-hand-holding-usd"></i>
                    Doador
                </a>
            </li>
            <li>
                <a href="<?php echo $url; ?>/dashboard/case" class="<?php echo (end($params) == 'case') ? 'active' : '';?>">
                    <i class="fas fa-people-carry"></i>
                    Casos para ajuda
                </a>
            </li>
            <li>
                <a href="<?php echo $url; ?>/dashboard/messages" class="<?php echo (end($params) == 'messages') ? 'active' : '';?>">
                    <i class="fas fa-envelope"></i>
                    Mensagens
                </a>
            </li>
            
        </ul>
    </div>
</aside>