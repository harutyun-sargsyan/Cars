<aside class="main-sidebar">

    <section class="sidebar">


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [


                    ['label' => 'Cars', 'icon' => 'file-code-o', 'url' => ['/cars']],


                ],
            ]
        ) ?>

    </section>

</aside>
