<aside>
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php else : ?>
        <p>Добавьте виджеты через админ-панель.</p>
    <?php endif; ?>
</aside>
