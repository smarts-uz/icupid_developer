<div class="content">
    
    <?php
    echo getMarketSiteHtml("dashboard");
    ?>
    
    <div class="block-4">
      <div class="box">
        <div class="box-heading">
          <h2>Site Stats :</h2>
        </div>
        <div class="box-content">
          <div class="field m-market-comm"><label id="total_sites">?</label><span>Total Sites</span></div>
          <div class="field m-date-format"><label id="total_users">?</label><span>Total Users</span></div>
          <div class="field m-banned-usernames"><label id="total_markets">?</label><span>Total Markets</span></div>
          <div class="field m-seo-fiendly"><label id="total_payments">?</label><span>Total Payments</span></div>
          <div class="field m-lang-flag"><label id="total_banners">?</label><span>Total Banners</span></div>
          <div class="field m-enable-ghost-login"><label id="pending_sites">?</label><span>Total Pending Sites</span></div>
          <div class="field m-ghost-login-amount"><label id="pending_media">?</label><span>Total Pending Media</span></div>
          <div class="field m-affiliate-currency"><label id="pending_edits">?</label><span>Total Pending Edits</span></div>
        </div>
      </div>
      
    </div>

    <div class="block-4">
      <div class="box">
        <div class="box-heading">
          <h2>User Stats :</h2>
        </div>
        <div class="box-content">
          
          <div class="field m-market-comm"><label id="total_users_online">?</label><span>Total Users Online</span></div>
          <div class="field m-date-format"><label id="total_mail_sent">?</label><span>Total Emails Sent</span></div>
          <div class="field m-banned-usernames"><label id="total_winks">?</label><span>Total Winks Sent</span></div>
          <div class="field m-seo-fiendly"><label id="total_comments">?</label><span>Total Comments</span></div>
          <div class="field m-lang-flag"><label id="total_albums">?</label><span>Total Albums</span></div>
          <div class="field m-enable-ghost-login"><label id="pending_music">?</label><span>Total Musics</span></div>
          <div class="field m-ghost-login-amount"><label id="pending_video">?</label><span>Total Videos</span></div>
          <div class="field m-affiliate-currency"><label id="pending_youtube">?</label><span>Total Youtube Videos</span></div>
        </div>
      </div>
      
    </div>


    <div class="block-4">
      <div class="box">
        <div class="box-heading">
          <h2>Payment Stats:</h2>
        </div>
        <div class="box-content">
          
          <div class="field m-market-comm"><label id="total_earnings">?</label><span>Total Earnings</span></div>
          <div class="field m-date-format"><label id="total_admin_earnings">?</label><span>Total Admin Earnings</span></div>
          <div class="field m-banned-usernames"><label id="total_customer_earnings">?</label><span>Total Customer Earnings</span></div>
          <?php /*<div class="field m-seo-fiendly"><label>$568</label><span>Total Affiliate Earnings</span></div>
          <div class="field m-lang-flag"><label>$25</label><span>Total Chargebacks</span></div>
          <div class="field m-enable-ghost-login"><label>12</label><span>Total Refunds</span></div>
          <div class="field m-ghost-login-amount"><label>5</label><span>Total Subscriptions</span></div>
          <div class="field m-affiliate-currency"><label>3</label><span>Total Cancelled Subscriptions</span></div> */ ?>
          
        </div>
      </div>
    </div>
    <div class="box">
      <!--  HIGHCHART CODE START -->

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){

      var market_id = $("#select-market").val();
      
      if(market_id == ""){
        market_id = 0;  
      }
      var site_id = $("#select-site").val();
      
      if(site_id == ""){
        site_id = 0;  
      }

      WLDGetDashboardFigures(market_id,site_id);

    });

    function WLDGetDashboardFigures(market_id = 0, site_id = 0){

      var market_id = $("#select-market").val();
      var site_id = $("#select-site").val();
      if(!site_id){
        site_id = 0;
      }

      $.ajax({
        url:"<?php echo DB_DOMAIN;?>newadmin/wld/ajax/json_actions.php?action=getDashboardFigures",
          type:"POST",
          data: {market_id : market_id , site_id : site_id},
          success: function(response){
            
            var rlt = $.parseJSON(response);

            $("#total_sites").html(rlt.total_sites);
            $("#total_users").html(rlt.total_users);
            $("#total_markets").html(rlt.total_markets);
            $("#pending_sites").html(rlt.pending_sites);
            $("#pending_media").html(rlt.pending_media);
            $("#pending_music").html(rlt.pending_music);
            $("#pending_video").html(rlt.pending_video);
            $("#pending_youtube").html(rlt.pending_youtube);
            $("#total_albums").html(rlt.total_albums);
            $("#total_comments").html(rlt.total_comments);
            $("#total_mail_sent").html(rlt.total_mail_sent);
            $("#total_users_online").html(rlt.total_users_online);
            $("#total_winks").html(rlt.total_winks);
            $("#total_payments").html(rlt.total_payments);
            $("#total_banners").html(rlt.total_banners);
            $("#total_earnings").html("$" + rlt.total_earnings);
            $("#total_admin_earnings").html("$" + rlt.total_admin_earnings);
            $("#total_customer_earnings").html("$" + rlt.total_customer_earnings);

            var cats = $.map(rlt.graph_cats, function(value, index) { return [value]; });
            var sites = $.map(rlt.graph_sites, function(value, index) { return [value]; });
            var regs = $.map(rlt.graph_regs, function(value, index) { return [value]; });
            var pays = $.map(rlt.graph_pays, function(value, index) { return [value]; });


            WLDGetDashboardGraphFigures(cats, sites, regs, pays);
          },
          error: function(response){
              
            $(".output-update-market").hide();
            alert("Error in loading contents, please try again.");
            console.log(response);
          
          }
        });

    }
    </script>

    <script type="text/javascript">
    function WLDGetDashboardGraphFigures(cats, sites, regs, pays) {
      $('#wld-container').highcharts({
        title: {
          text: 'This Week',
          x: 20 ,//center
          align: 'left'
        },
        subtitle: {
          text: '',
          x: -20
        },
        xAxis: {
           categories: cats
        },
        yAxis: {
          title: {
            text: 'Users'
          },
          plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
          }]
        },
        legend: {
          layout: 'horizontal',
          align: 'center',
          verticalAlign: 'bottom',
          borderWidth: 0
        },
        series: [{
          name: 'New Sites',
          data: sites
        }, {
          name: 'New Registrations',
          data: regs
        }, {
          name: 'New Member Payments',
          data: pays
        }]
    });
  }
  </script>
  
  <script src="inc/js/highcharts.js"></script>
  <script src="inc/js//exporting.js"></script>

  <div id="wld-container" style="width: 100%; height: 400px; margin: 30px auto"></div>

  </div>
</div>



