
    <header>
    <h1 class="header_name h2 text-dark mt-4 mb-4">読書ログの一覧</h1>
    </header>

    <div>
    <a href="new.php" class=" btn btn-primary mb-4">読書ログを登録する</a>
    <?php if(count($reviews) > 0):?>
    <?php foreach($reviews as $review): ?>
    <section class="card shadow-sm mb-4">
    <div class="card-body">
    <h2 class="card-title h4 mb-3">
    <?php echo escape($review['title']); ?>
    </h2>
        <div>
        <?php echo '著者名:' . escape($review['author']);?>&nbsp;/&nbsp;
        <?php echo '読書状況:' . escape($review['status']);?>&nbsp;/&nbsp;
        <?php echo '評価:' . escape($review['score']);?>点
        </div>
        <br>
    <p>
        <?php echo nl2br(escape($review['summary'])); ?>
    </p>

        <form action="delete.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $review['id']?>">
        <input type="submit" class="btn btn-primary" value="削除する">
        </form>




    </div>
    </section>
    <?php endforeach;?>

<?php else:?>
<p>読書ログが登録されていません。</p>
<?php endif; ?>
    <div>
