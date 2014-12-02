
<?php

    include_once '../includes/functions.php';

    $manuscript;
    $edit = false;
    $submit_btn_val = "Submit";
    if(isset($_GET['id'])){
      $edit = true;
      $submit_btn_val = "Save Changes";
      $manuscript = getManuscriptById($_GET['id']);
      
    }

?>
<style>
    .form-horizontal .control-label{
        padding-top: 7px;
        text-align: right;;
    }
</style>

<form class="form-horizontal" name="manu_form">

        <legend>Manuscript Details </legend>

                <!-- Link # and Part-->
                <div class="form-group">
                  <label class="control-label col-xs-2" for="mlinkno">Manuscript Link #</label>
                  <div id='manu_form_mlinkno_errorloc' ></div>
                  <div class="col-xs-3">
                    <input id="mlinkno" name="mlinkno" type="text" placeholder="Mlink #" class="form-control" required="true" value=<?php if($edit){echo "'" . $manuscript->mlinknum . "'"; }?> <?php if(isset($_GET['id'])){echo "disabled=true"; }?>>
                  </div>

                  <label class="control-label col-xs-2" for="part">Manuscript Part</label>
                  <div class="col-xs-1">
                    <select id="part" name="part" class="form-control" required="true">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                    </select>
                  </div>

                </div>

                <!-- Date and Century-->
                <div class="form-group">
                  <label class="control-label col-xs-2" for="dateMS">Manuscript Date</label>
                  <div class="col-xs-3">
                    <input id="dateMS" name="dateMS" type="text" placeholder="Date" class="form-control" maxlength="20" value=<?php if($edit){echo "'" . $manuscript->date_manu . "'"; }?> > 
                  </div>

                  <label class="control-label col-xs-2" for="century">Century</label>
                  <div class="col-xs-3"> 
                    <input id="century" name="century" type="text" placeholder="" class="form-control"  maxlength="45" value=<?php if($edit){echo "'" . $manuscript->century . "'"; } ?> >
                  </div>
                </div>

                

                <!-- Text type and liturgical use-->
                <div class="form-group">
                  <label class="control-label col-xs-2" for="text_type">Text Type</label>
                  <div class="col-xs-3">
                    <input id="text_type" name="text_type" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $manuscript->text_type . "'"; }?> >
                  </div>

                  <label class="control-label col-xs-2" for="liturgical">Liturgical Use</label>
                  <div class="col-xs-3">
                    <input id="liturgical" name="liturgical" type="text" placeholder="" class="form-control" maxlength="45" value=<?php if($edit){echo "'" . $manuscript->liturgical_use . "'"; }?> >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="writing_sup">Writing Support</label>
                  <div class="col-xs-3">
                    <input id="writing_sup" name="writing_sup" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $manuscript->writing_sup . "'"; }?> >
                  </div>

                  <label class="control-label col-xs-2" for="liturgical">Schoenberg #</label>
                  <div class="col-xs-3">
                    <input id="schoenberg" name="schoenberg" type="text" placeholder="" class="form-control" maxlength="100"  value=<?php if($edit){echo "'" . $manuscript->schoen_num . "'"; }?> >
                  </div>
                </div>
                

                <!-- Text input-->
                <div class="form-group">
                  <label class="control-label col-xs-2" for="subj_lcsh">Subject LCSH</label>
                  <div class="col-xs-3">
                    <textarea id="subj_lcsh" name="subj_lcsh" type="textarea" placeholder="" class="form-control" value=<?php if($edit){echo "'" . $manuscript->subject_lcsh . "'"; }?> ></textarea>
                  </div>

                  <label class="control-label col-xs-2" for="lang">Language</label>
                  <div class="col-xs-3">
                    <input id="lang" name="lang" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $manuscript->language . "'"; }?> >
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="control-label col-xs-2" for="rul_med">Ruling Medium</label>
                  <div class="col-xs-3">
                    <input id="rule_med" name="rule_med" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $manuscript->ruling_med . "'"; }?> > 
                  </div>

                  <label class="control-label col-xs-2" for="rule_pat">Ruling Pattern</label>
                  <div class="col-xs-3">
                    <input id="rule_pat" name="rule_pat" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $manuscript->ruling_pat . "'"; }?> >
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="control-label col-xs-2" for="collation">Collation</label>
                  <div class="col-xs-3">
                    <input id="collation" name="collation" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $manuscript->collation . "'"; }?> >
                  </div>

                  <label class="control-label col-xs-2" for="deco">Decoration</label>
                  <div class="col-xs-3">
                    <textarea id="deco" name="deco" type="text" placeholder="" class="form-control" value=<?php if($edit){echo "'" . $manuscript->decoration . "'"; }?> ></textarea>
                  </div>
                </div>

                
                <!-- Text input-->
                <div class="form-group">
                  <label class="control-label col-xs-2" for="miniatures">Miniatures</label>
                  <div class="col-xs-3">
                    <textarea id="miniatures" name="miniatures" type="text" placeholder="" class="form-control" value=<?php if($edit){echo "'" . $manuscript->miniatures . "'"; }?> ></textarea>
                  </div>

                  <label class="control-label col-xs-2" for="history">History</label>
                  <div class="col-xs-3">
                    <textarea id="history" name="history" type="text" placeholder="" class="form-control" value=<?php if($edit){echo "'" . $manuscript->history . "'"; }?> ></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="text_cont">Text Contents</label>
                  <div class="col-xs-3">
                    <input id="text_cont" name="text_cont" type="text" placeholder="" class="form-control" maxlength="200" value=<?php if($edit){echo "'" . $manuscript->text_contents . "'"; }?> ></textarea>
                  </div>

                  <label class="control-label col-xs-2" for="script">Script</label>
                  <div class="col-xs-3">
                    <input id="script" name="script" type="text" placeholder="" class="form-control" maxlength="200" value=<?php if($edit){echo "'" . $manuscript->script . "'"; }?> >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="artist">Artist</label>
                  <div class="col-xs-3">
                    <input id="artist" name="artist" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $manuscript->artist . "'"; }?> >
                  </div>

                  <label class="control-label col-xs-2" for="scribe">Scribe</label>
                  <div class="col-xs-3">
                    <input id="scribe" name="scribe" type="text" placeholder="" class="form-control" maxlength="200" value=<?php if($edit){echo "'" . $manuscript->scribe . "'"; }?> >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="biblio">Bibliography</label>
                  <div class="col-xs-3">
                    <textarea id="biblio" name="biblio" placeholder="" class="form-control" value=<?php if($edit){echo "'" . $manuscript->biblio . "'"; }?> ></textarea>
                  </div>

                  <label class="control-label col-xs-2" for="avail_folios"># of available folios</label>
                  <div class="col-xs-1">
                    <input id="avail_folios" name="avail_folios" type="number" placeholder="" class="form-control" min="0" max="1000" <?php if($edit){echo "value=$manuscript->no_of_avail_fol";}; ?>>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="cited">Edition Cited</label>
                  <div class="col-xs-3">
                    <textarea id="cited" name="cited" placeholder="" class="form-control" value=<?php if($edit){echo "'" . $manuscript->edition_cited . "'"; }?> ></textarea>
                  </div>

                  <label class="control-label col-xs-2" for="no_of_folios"># of folios</label>
                  <div class="col-xs-1">
                    <input id="no_of_folios" name="no_of_folios" type="number" placeholder="" class="form-control" min="0" max="1000" <?php if($edit){echo "value=$manuscript->no_of_fol";}; ?>>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="pub_digital">Publisher Digital</label>
                  <div class="col-xs-3">
                    <textarea id="pub_digital" name="pub_digital" placeholder="" class="form-control" value=<?php if($edit){echo "'" . $manuscript->pub_digital . "'"; }?> ></textarea>
                  </div>
                  
                </div>

        <legend>Origin Details </legend>


                <div class="form-group">
                  <label class="control-label col-xs-2" for="country">Country</label>
                  <div class="col-xs-3">
                    <input id="country" name="country" type="text" placeholder="Date" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $manuscript->origin->country . "'"; }?> >
                  </div>

                  <label class="control-label col-xs-2" for="state">State</label>
                  <div class="col-xs-3">
                    <input id="state" name="state" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $manuscript->origin->state . "'"; }?> >
                  </div>
                </div>

                

                <!-- Text type and liturgical use-->
                <div class="form-group">
                  <label class="control-label col-xs-2" for="region">Region</label>
                  <div class="col-xs-3">
                    <input id="region" name="region" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $manuscript->origin->region . "'"; }?> >
                  </div>

                  <label class="control-label col-xs-2" for="municipality">Municipality</label>
                  <div class="col-xs-3">
                    <input id="municipality" name="municipality" type="text" placeholder="" class="form-control"  maxlength="100" value=<?php if($edit){echo "'" . $manuscript->origin->municipality . "'"; }?> >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-xs-2" for="institution">Institution</label>
                  <div class="col-xs-3">
                    <textarea id="institution" name="institution" type="text" placeholder="" class="form-control" value=<?php if($edit){echo "'" . $manuscript->origin->institution . "'"; }?> ></textarea>
                  </div>

                  <label class="control-label col-xs-2" for="comm_agent">Commissioning Agent</label>
                  <div class="col-xs-3">
                    <input id="comm_agent" name="comm_agent" type="text" placeholder="" class="form-control" maxlength="100" value=<?php if($edit){echo "'" . $manuscript->origin->commagent . "'"; }?> >
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
        window.location.href = 'manuscripts.php';
      });
  });

  $('form').bind('submit', function () {
    $.ajax({
      type: 'get',
      url: 'saveManuscripts.php',
      data: $('form').serialize(),
      contentType: 'application/json',
      success: function (data) {
        var msg = jQuery.parseJSON(data);
        if(msg.statusNum == 201){
            alert(msg.statusMsg);
        }else{
            alert("Manuscript details saved succesfully.");
        }
      }
    });
    return false;
  });
  
</script>


