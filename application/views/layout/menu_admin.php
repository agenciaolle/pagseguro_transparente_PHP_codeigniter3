
<div id="sidebar-wrapper" class="bg-dark">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="#" class="text-white">
                Administrador
            </a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "evento", "listar"));?>">Listar Ações/Projetos</a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "evento", "registrar"));?>">Registrar Ações/Projetos</a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "exportar")); ?>">Exportar Ações/Projetos</a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "tipo", "listar"));?>">Listar Tipos</a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "tipo", "registrar"));?>">Registrar Tipo</a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "unidade", "listar"));?>">Listar Unidades</a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "unidade", "registrar"));?>">Registrar Unidade</a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "responsavel", "listar"));?>">Listar Responsáveis</a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "responsavel", "registrar"));?>">Registrar Responsável</a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "email", "acesso"));?>">E-mail de acesso</a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "email", "acessoregistrareventorealizado"));?>">E-mail registrar ação/projeto realizado</a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "email", "aviso"));?>">E-mail de aviso</a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "email", "encerramento"));?>">E-mail de Encerramento</a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "relatoriocfn", "registrar")); ?>"><b>Registrar Relatório</b></a>
        </li>
        <li>
            <a class="text-white" href="<?php echo site_url(array("admin", "relatoriocfn", "exportar")); ?>">Relatório CFN - Exportar</a>
        </li>                           
        <li>
            <a class="text-white" href="<?php echo site_url(array("home", "logout")); ?>">Sair do Sistema</a>
        </li>
    </ul>
</div>