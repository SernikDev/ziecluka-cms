<div class="container">
    <div class="section">
        <div class="row">
            <h3 class="blue-text"><?php echo $this->pageInfo[0]['page_name'] ?></h3>
        </div>
        <div class="row">
            <div class="content">
                <?php echo $this->pageInfo[0]['page_content'] ?>
            </div>
        </div>
        <?php print_r($this->pageInfo) ?>
    </div>
</div>