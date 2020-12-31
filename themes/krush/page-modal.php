<?php 
/* Template Name: Modal */
get_header(); 
?>

<section class="modal-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="modal-sec">
          <ul class="reset-list" style="text-align: center;">
            <li style="display: inline-block; vertical-align: baseline; margin: 20px;">
              <button data-toggle="modal" data-target="#ftws-modal-02">First time with us? 2</button>
            </li>
            <li style="display: inline-block; vertical-align: baseline; margin: 20px;">
              <button data-toggle="modal" data-target="#ftwsModal01">First time with us? 1</button>
            </li>

          </ul>
        </div>
      </div>
    </div>
  </div>
</section>



<div class="modal fade ftws-modal-cntlr" id="ftws-modal-02" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">

          <div class="ftws-modal-con ftws-modal-con-2">
            <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
            </button>
            <div class="ftws-modal-con-img">
              <div style="background: url(<?php echo THEME_URI;?>/assets/images/pop-up-2.png);"></div>
            </div>
            <div class="ftws-modal-con-des">
              <div>
                <p>פעם ראשונה אצלנו?   </p>
                <p>הצטרפי לניוזלטר וקבלי <br>15% הנחה בקניה הראשונה </p>
                <div class="modal-btns">
                  
                  <label>הקלידי את המייל  </label>
                  <button>שלחי  </button>
                </div>
              </div>
            </div>
            
          </div>
      </div>
  </div>
</div>

<div class="modal fade ftws-modal-cntlr" id="ftwsModal01" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <div class="ftws-modal-con ftws-modal-con-1">
            <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
            </button>
            <div class="ftws-modal-con-img">
              <div style="background: url(<?php echo THEME_URI;?>/assets/images/pop-up-1.png);"></div>
            </div>
            <div class="ftws-modal-con-des">
              <div>
                <p>פעם ראשונה אצלנו?   </p>
                <p>הצטרפי לניוזלטר וקבלי <br>15% הנחה בקניה הראשונה </p>
                <div class="modal-btns">
                  
                  <label>הקלידי את המייל  </label>
                  <button>שלחי  </button>
                </div>
              </div>
            </div>
            
          </div>
      </div>
  </div>
</div>



  
<?php 
get_footer(); 
?>