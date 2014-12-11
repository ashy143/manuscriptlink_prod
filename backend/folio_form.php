
<?php

    include_once '../includes/functions.php';

    $folio;
    $edit = false;
    $submit_btn_val = "Submit";
    $ref_folio_id = NULL;
    if(isset($_GET['id'])){
      $edit = true;
      $ref_folio_id = $_GET['id'];
      $submit_btn_val = "Save Changes";
      $folio = getFolioById($_GET['id']);
      
    }

?>
<style>
    .form-horizontal .control-label{
        padding-top: 7px;
        text-align: right;;
    }
</style>

<form class="form-horizontal" method="POST" action="saveFolios.php" enctype="multipart/form-data">

        <legend>Folio Details </legend>

                <!-- Save the refernce folio id if it is edit mode-->
                <input type="hidden" name='ref_folio_id' value = <?php echo $ref_folio_id; ?> >

                <div class="form-group">
                  <label class="control-label col-xs-2" for="mscript">Manuscript</label>
                  <div class="col-xs-3">
                    <?php if($edit){ ?>
                      <input id="mscript" name="mscript" type="text" class="form-control"  required="" value=<?php if($edit){echo "'" . $folio->mlink_part . "'"; } ?> >
                    <?php } else {?>
                      <input id="mscript" name="mscript" type="text" class="form-control"  placeholder="eg. 10000001.1" required="">
                    <?php } ?>
                  </div>
                  <label class="control-label col-xs-2" for="title">Title or Genre</label>
                  <div class="col-xs-3"> 
                    <input id="title" name="title" type="text" placeholder="" class="form-control" maxlength="200" value=<?php if($edit){echo "'" . $folio->title . "'"; } ?> >
                  </div>
                </div>

                <!-- Date and Century-->
                <div class="form-group">
                  <label class="control-label col-xs-2" for="alt_title">Alternative Title</label>
                  <div class="col-xs-3">
                    <input id="alt_title" name="alt_title" type="text" placeholder="" class="form-control" maxlength="200" value=<?php if($edit){echo "'" . $folio->alt_title . "'"; }?> > 
                  </div>

                  <label class="control-label col-xs-2" for="author">Author or Creator</label>
                  <div class="col-xs-3"> 
                    <input id="author" name="author" type="text" placeholder="" class="form-control"  maxlength="100" value=<?php if($edit){echo "'" . $folio->author . "'"; } ?> >
                  </div>
                </div>

                

                <!-- Text type and liturgical use-->
                <div class="form-group">
                  <label class="control-label col-xs-2" for="date_text">Date of Text</label>
                  <div class="col-xs-3">
                    <input id="date_text" name="date_text" type="date" placeholder="" class="form-control" value=<?php if($edit){echo "'" . $folio->date_text . "'"; }?> >
                  </div>

                  <label class="control-label col-xs-2" for="folio_contents">Sequential Folio Contents</label>
                  <div class="col-xs-3">
                    <textarea id="folio_contents" name="folio_contents" type="text"  class="form-control"  value=<?php if($edit){echo "'" . $folio->folio_contents . "'"; }?> ></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="folio_prov">Folio Provenance</label>
                  <div class="col-xs-3">
                    <textarea id="folio_prov" name="folio_prov" type="text" placeholder="" class="form-control"  value=<?php if($edit){echo "'" . $folio->folio_prov . "'"; }?> ></textarea>
                  </div>
                </div>
                

                <!-- Text input-->
                <div class="form-group">
                  <label class="control-label col-xs-2" for="fol_num">Folio Number</label>
                  <div class="col-xs-3">
                    <input id="fol_num" name="fol_num" type="number" placeholder="" class="form-control" min="0" max="1000" <?php if($edit){echo "value=$folio->folio_num";}; ?>>
                  </div>

                  <label class="control-label col-xs-2" for="fol_side">Folio Side</label>
                  <div class="col-xs-3">
                    <select id="fol_side" name="fol_side" class="form-control" >
                      <option value='r'>recto</option>
                      <option value='v'>verso</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="no_of_lines"># of lines</label>
                  <div class="col-xs-3">
                    <input id="no_of_lines" name="no_of_lines" type="number" placeholder="" class="form-control" min="0" max="1000" <?php if($edit){echo "value=$folio->no_of_lines";}; ?>>
                  </div>

                  <label class="control-label col-xs-2" for="no_of_lines_broken"># of lines broken</label>
                  <div class="col-xs-5">
                    <input id="no_of_lines_broken" name="no_of_lines_broken" type="checkbox" placeholder="" class="form-control"  >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="no_of_col"># of columns</label>
                  <div class="col-xs-3">
                    <input id="no_of_col" name="no_of_col" type="number" placeholder="" class="form-control" min="0" max="1000" <?php if($edit){echo "value=$folio->no_of_cols";}; ?>>
                  </div>

                  <label class="control-label col-xs-2" for="no_of_lines_broken"># of columns broken</label>
                  <div class="col-xs-5">
                    <input id="no_of_lines_broken" name="no_of_lines_broken" type="checkbox" placeholder="" class="form-control"  >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="quire_sign">Quire Signatures</label>
                  <div class="col-xs-3">
                    <input id="quire_sign" name="quire_sign" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $folio->quire_sign . "'"; }?> > 
                  </div>

                  <label class="control-label col-xs-2" for="catchwords">Catchwords</label>
                  <div class="col-xs-3">
                    <textarea id="catchwords" name="catchwords" type="text"  class="form-control"  value=<?php if($edit){echo "'" . $folio->catch_words . "'"; }?> ></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="neumes">Neumes</label>
                  <div class="col-xs-3">
                    <textarea id="neumes" name="neumes" type="text"  class="form-control"  value=<?php if($edit){echo "'" . $folio->neumes . "'"; }?> ></textarea>
                  </div>
                  <label class="control-label col-xs-2" for="lines_per_staff"># of Lines Per Staff</label>
                  <div class="col-xs-3">
                     <input id="lines_per_staff" name="lines_per_staff" type="number" placeholder="" class="form-control" min="0" max="1000" value= <?php if($edit){echo "'" . $folio->lines_per_staff . "'"; }?> >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="staves_per_page"># of Musical Staves Per Page</label>
                  <div class="col-xs-3">
                     <input id="staves_per_page" name="staves_per_page" type="number" placeholder="" class="form-control" min="0" max="1000" value= <?php if($edit){echo "'" . $folio->staves_per_page . "'"; }?> >
                  </div>
                  <label class="control-label col-xs-2" for="staves_per_page_broken"># of Musical Staves Per Page broken</label>
                  <div class="col-xs-5">
                    <input id="staves_per_page_broken" name="staves_per_page_broken" type="checkbox" placeholder="" class="form-control"  >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="dim_staff">Dimension of Musical Staff</label>
                  <div class="col-xs-3">
                     <input id="dim_staff" name="dim_staff" type="number" placeholder="" class="form-control" min="0" max="1000" value= <?php if($edit){echo "'" . $folio->dim_staff . "'"; }?> >
                  </div>
                  <label class="control-label col-xs-2" for="col_staff">Color of Staff Lines</label>
                  <div class="col-xs-3">
                    <input id="col_staff" name="col_staff" type="text" placeholder="" class="form-control" value= <?php if($edit){echo "'" . $folio->col_staff . "'"; }?> >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="contrib_inst">Contributing Institution</label>
                  <div class="col-xs-3">
                    <textarea id="contrib_inst" name="contrib_inst" type="text"  class="form-control"  value=<?php if($edit){echo "'" . $folio->contrib_inst . "'"; }?> ></textarea>
                  </div>

                  <label class="control-label col-xs-2" for="rights_mgmt">Rights Management</label>
                  <div class="col-xs-3">
                    <textarea id="rights_mgmt" name="rights_mgmt" type="text"  class="form-control"  value=<?php if($edit){echo "'" . $folio->rights_mgmt . "'"; }?> ></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="image_format">Image Format</label>
                  <div class="col-xs-3">
                    <input id="image_format" name="image_format" type="text" placeholder="" class="form-control" maxlength="45" value=<?php if($edit){echo "'" . $folio->image_format . "'"; }?> > 
                  </div>
                  <label class="control-label col-xs-2" for="date_digital">Date Digital</label>
                  <div class="col-xs-3">
                    <input id="date_digital" name="date_digital" type="text" placeholder="" class="form-control" maxlength="20" value=<?php if($edit){echo "'" . $folio->date_digital . "'"; }?> > 
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="digit_specs">Digitization Specifications</label>
                  <div class="col-xs-3">
                    <textarea id="digit_specs" name="digit_specs" type="text"  class="form-control"  value=<?php if($edit){echo "'" . $folio->digit_specs . "'"; }?> ></textarea>
                  </div>

                  <label class="control-label col-xs-2" for="meta_catag">Metadata Cataloger</label>
                  <div class="col-xs-3">
                    <textarea id="meta_catag" name="meta_catag" type="text"  class="form-control"  value=<?php if($edit){echo "'" . $folio->meta_catag . "'"; }?> ></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="website">Website</label>
                  <div class="col-xs-3">
                    <textarea id="website" name="website" type="text" placeholder="" class="form-control"  value=<?php if($edit){echo "'" . $folio->website . "'"; }?> ></textarea>
                  </div>

                  <label class="control-label col-xs-2" for="scan_tech">Scanner Technician</label>
                  <div class="col-xs-3">
                    <input id="scan_tech" name="scan_tech" type="text" placeholder="" class="form-control" maxlength="200"  value=<?php if($edit){echo "'" . $folio->scan_tech . "'"; }?> >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="coll_admin">Collection Administrator</label>
                  <div class="col-xs-3">
                    <input id="coll_admin" name="coll_admin" type="text" placeholder="" class="form-control" maxlength="200" value=<?php if($edit){echo "'" . $folio->coll_admin . "'"; }?> > 
                  </div>
                  <label class="control-label col-xs-2" for="faculty_liason">Faculty Liaison</label>
                  <div class="col-xs-3">
                    <input id="faculty_liason" name="faculty_liason" type="text" placeholder="" class="form-control" maxlength="200" value=<?php if($edit){echo "'" . $folio->faculty_liason . "'"; }?> > 
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="abreviated_shelf">Abbreviated Shelfmark</label>
                  <div class="col-xs-3">
                    <input id="abreviated_shelf" name="abreviated_shelf" type="text" placeholder="" class="form-control" maxlength="200" value=<?php if($edit){echo "'" . $folio->abbreviated_shelf . "'"; }?> > 
                  </div>
                  
                </div>


            <legend>Dimensions</legend>



                <div class="form-group">
                  <label class="control-label col-xs-2" for="height">Height</label>
                  <div class="col-xs-3">
                    <input id="height" name="height" type="text" placeholder="" class="form-control" >
                  </div>

                  <label class="control-label col-xs-2" for="ht_fol_broken">Height broken</label>
                  <div class="col-xs-5">
                    <input id="ht_fol_broken" name="ht_fol_broken" type="checkbox" placeholder="" class="form-control"  >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="width">Width</label>
                  <div class="col-xs-3">
                    <input id="width" name="width" type="text" placeholder="" class="form-control" >
                  </div>

                  <label class="control-label col-xs-2" for="width_fol_broken">Width broken</label>
                  <div class="col-xs-5">
                    <input id="width_fol_broken" name="width_fol_broken" type="checkbox" placeholder="" class="form-control"  >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="height_written">Height of Written Space </label>
                  <div class="col-xs-3">
                    <input id="height_written" name="height_written" type="text" placeholder="" class="form-control"  >
                  </div>

                  <label class="control-label col-xs-2" for="ht_written_space_broken">Height of written space broken</label>
                  <div class="col-xs-5">
                    <input id="ht_written_space_broken" name="ht_written_space_broken" type="checkbox" placeholder="" class="form-control"  >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="width_written">Width of Written Space </label>
                  <div class="col-xs-3">
                    <input id="width_written" name="width_written" type="text" placeholder="" class="form-control"  >
                  </div>

                  <label class="control-label col-xs-2" for="width_written_space_broken">Width of written space broken</label>
                  <div class="col-xs-5">
                    <input id="width_written_space_broken" name="width_written_space_broken" type="checkbox" placeholder="" class="form-control"  >
                  </div>
                </div>

        <legend>Location Details </legend>


                <div class="form-group">
                  <label class="control-label col-xs-2" for="country">Country</label>
                  <div class="col-xs-3">
                    <input id="country" name="country" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $folio->folio_location->country . "'"; }?> >
                  </div>

                  <label class="control-label col-xs-2" for="state">State</label>
                  <div class="col-xs-3">
                    <input id="state" name="state" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $folio->folio_location->state . "'"; }?> >
                  </div>
                </div>

                

                <!-- Text type and liturgical use-->
                <div class="form-group">
                  <label class="control-label col-xs-2" for="division">Library and Division</label>
                  <div class="col-xs-3">
                    <input id="division" name="division" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $folio->folio_location->division . "'"; }?> >
                  </div>

                  <label class="control-label col-xs-2" for="municipality">Municipality</label>
                  <div class="col-xs-3">
                    <input id="municipality" name="municipality" type="text" placeholder="" class="form-control"  maxlength="100" value=<?php if($edit){echo "'" . $folio->folio_location->municipality . "'"; }?> >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="institution">Institution</label>
                  <div class="col-xs-3">
                    <textarea id="institution" name="institution" type="text" placeholder="" class="form-control" value=<?php if($edit){echo "'" . $folio->folio_location->institution . "'"; }?> ></textarea>
                  </div>

                  <label class="control-label col-xs-2" for="collection">Collection</label>
                  <div class="col-xs-3">
                    <input id="collection" name="collection" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $folio->folio_location->collection . "'"; }?> >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="callno">Call Number</label>
                  <div class="col-xs-3">
                    <input id="callno" name="callno" type="text" placeholder="" class="form-control" maxlength="200" value=<?php if($edit){echo "'" . $folio->folio_location->locationcol . "'"; }?> >
                  </div>

                  <label class="control-label col-xs-2" for="series">Series</label>
                  <div class="col-xs-3">
                    <input id="series" name="series" type="text" placeholder="" class="form-control"  maxlength="200" value=<?php if($edit){echo "'" . $folio->folio_location->series . "'"; }?> >
                  </div>
                </div>


               <div class="form-group">
                <label class="control-label col-xs-2" for="institution">Comments</label>
                <div class="col-xs-5">
                  <textarea id="comments" name="comments" type="text" placeholder="" class="form-control" ></textarea>
                </div>
              </div>

              <legend>Image Upload </legend>

              <div class="form-group">
                <label class="control-label col-xs-2" for="file">Select file to upload</label>
                <div class="col-xs-5">
                  <input type="file" id="file" name="file" accept="image/*" class="form-control" required="">
                </div>
              </div> 

              <!-- User will specify the values we are asking for to create a directory structure and then upload -->

              <p style='color:black;'>Image will be uploaded according to values specified below. For eg. Institution/Date of acquisition/collection/ms call no/images/image name.jpeg</p>
              <div class="form-group">
                <label class="control-label col-xs-2" for="image_institution">Institution</label>
                <div class="col-xs-3">
                  <input id="image_institution" name="image_institution" type="text" placeholder="" class="form-control" required="">
                </div>
                <label class="control-label col-xs-2" for="image_collection">Collection</label>
                <div class="col-xs-3">
                  <input id="image_collection" name="image_collection" type="text" placeholder="" class="form-control" required="">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-xs-2" for="image_shelfmark">Shelfmark</label>
                <div class="col-xs-3">
                  <input id="image_shelfmark" name="image_shelfmark" type="text" placeholder="" class="form-control" required="">
                </div>
                <label class="control-label col-xs-2" for="image_name">Folio name</label>
                <div class="col-xs-3">
                  <input id="image_name" name="image_name" type="text" placeholder="" class="form-control" required="">
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-2" style="float:right;">
                  <input type="submit" id="save_btn" value="<?php echo $submit_btn_val; ?>" class="form-control btn-success" >
                </div>
                <div class="col-xs-2" style="float:right;">
                  <input type="button" id="cancel_btn" value="<?php echo 'Cancel'; ?>" class="form-control btn-warning" >
                </div>
              </div>
</form>


<script>

  $(document).ready(function(){
      $("#cancel_btn").click(function(){
        window.location.href = 'folios.php';
      });
  });

  
  
</script>






