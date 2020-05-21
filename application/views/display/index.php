<div style="padding-top: 96px; padding-bottom: 96px;">
    <div class="w3-card w3-round-xlarge w3-content w3-theme-d3" style="max-width: 600px">
        <div class="w3-padding-large w3-center">
            <h1>Live Count</h1>
        </div>
        <div class="w3-padding"></div>
        <div class="w3-padding-large">
            <div class="w3-cell-row">
                <div class="w3-cell" style="width: 50%">
                    <h3>Jumlah suara masuk</h3>
                </div>
                <div class="w3-cell">
                    <h3>: <b><?php echo $all_votes; ?> dari <?php echo $voters; ?> suara</b></h3>
                </div>
            </div>
            <div class="w3-cell-row">
                <div class="w3-cell" style="width: 50%">
                    <h3>Persentase</h3>
                </div>
                <div class="w3-cell">
                    <h3>: <b><?php echo $percentage; ?>%</b></h3>
                </div>
            </div>
        </div>
        <div class="w3-padding"></div>
    </div>
</div>
<script>

var redirectTimer = window.setInterval(function() {
    window.clearInterval(redirectTimer);
    window.location.href = '<?php echo site_url('display'); ?>';
}, 30000);

</script>
