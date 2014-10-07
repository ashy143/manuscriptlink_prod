<?php 
    include_once './includes/functions.php';
    session_start();
    $juxt_folio_objs = getJuxtaImagesForLoggedInUser();
    $count = count($juxt_folio_objs);


?>
<style>
    .bookBtn,.delButton,.codexButton{ cursor: pointer; cursor: hand; }
</style>

<script>
    $(document).ready(function(){

        $('#bookshelf').delegate('#viewArchBtn', 'click', function () {
            window.location.href = 'myarchive.php';
        });
    });
</script>

<div id="bookHead">
    <h4>Bookshelf</h4>
    <a href="#"><i class="fa fa-caret-square-o-down"></i></a>
</div>
<div id="bookBody">
    <div class="book" id="book1">
        <div class="myBook" > 
            <?php if($count >= 1) { ?>
            <input type="checkbox" />
            <h4 data-folioid='<?php echo $juxt_folio_objs[0]->folio_id; ?>' data-mscriptid='<?php echo $juxt_folio_objs[0]->mscript_id; ?>' >  <?php echo $juxt_folio_objs[0]->abbreviated_shelf . ' (fol.' . $juxt_folio_objs[0]->folio_num . $juxt_folio_objs[0]->folio_side . ')'; ?></h4>
            <div class="delButton">Delete</div>
            <div class="codexButton">Codex</div>
            <?php } ?>
        </div>
    </div>
    <div class="book" id="book2">
        <div class="myBook">
            <?php if($count >= 2) { ?>
                <input type="checkbox" />
                <h4 data-folioid='<?php echo $juxt_folio_objs[1]->folio_id; ?>' data-mscriptid='<?php echo $juxt_folio_objs[1]->mscript_id; ?>' > <?php echo $juxt_folio_objs[1]->abbreviated_shelf . ' (fol.' . $juxt_folio_objs[1]->folio_num . $juxt_folio_objs[1]->folio_side . ')';  ?></h4>
                <div class="delButton">Delete</div>
                <div class="codexButton">Codex</div>
            <?php } ?>
        </div>
    </div>
    <div class="book" id="book3">
        <div class="myBook">
            <?php if($count >= 3) { ?>
                <input type="checkbox" />
                <h4 data-folioid='<?php echo $juxt_folio_objs[2]->folio_id; ?>' data-mscriptid='<?php echo $juxt_folio_objs[2]->mscript_id; ?>' > <?php echo $juxt_folio_objs[2]->abbreviated_shelf . ' (fol.' . $juxt_folio_objs[2]->folio_num . $juxt_folio_objs[2]->folio_side . ')';  ?></h4>
                <div class="delButton">Delete</div>
                <div class="codexButton">Codex</div>
            <?php } ?>
        </div>
    </div>
    <div class="book" id="book4">
        <div class="myBook">
            <?php if($count >= 4) { ?>
                <input type="checkbox" />
                <h4 data-folioid='<?php echo $juxt_folio_objs[3]->folio_id; ?>' data-mscriptid='<?php echo $juxt_folio_objs[3]->mscript_id; ?>' >  <?php echo $juxt_folio_objs[3]->abbreviated_shelf . ' (fol.' . $juxt_folio_objs[3]->folio_num . $juxt_folio_objs[3]->folio_side . ')';  ?></h4>
                <div class="delButton">Delete</div>
                <div class="codexButton">Codex</div>
            <?php } ?>

        </div>
    </div>             

    <div id="juxtaBtn" class="bookBtn">Add to Bookshelf</div>
    <div id="archiveBtn" class="bookBtn">Add to archive</div>
    <div id="jxtAndCmpBtn" class="bookBtn">juxtapose &amp; Compare</div>
    <div id="viewArchBtn" class="bookBtn">view archive</div>
</div>


