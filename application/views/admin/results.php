<div id="results-page" class="w3-padding-large">
    <div class="w3-cell-row w3-center">
        <?php foreach ($candidates as $candidate) { ?>
            <div class="w3-cell w3-padding-large">
                <div class="w3-card-4 w3-white">
                    <div class="w3-padding-large">
                        <h1><?php echo $candidate->id; ?></h1>
                    </div>
                    <div class="w3-display-container">
                        <div>
                            <img src="<?php echo base_url('public/img/candidate-'.$candidate->id.'.jpg'); ?>" class="w3-block" title="Pasangan <?php echo $candidate->id; ?>" width="350px" height="200px">
                        </div>
                        <div v-if="countingStarted">
                            <div style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.4)"></div>
                            <div class="w3-display-middle">
                                <h1 class="w3-text-white">{{ currentVotes[<?php echo $candidate->id; ?>] }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="w3-padding-large">
                        <h2><?php echo $candidate->pair_name; ?></h2>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="w3-center">
        <div class="w3-padding">
            <button v-on:click="startCounting()" v-bind:disabled="countingStarted" class="w3-btn w3-theme-action">Hitung</button>
        </div>
    </div>
</div>

<script>

var resultsPage = new Vue({
    el: '#results-page',
    data: {
        candidates: [],
        countingStarted: false,
        targetVotes: [],
        currentVotes: [],
        timer: null,
        maxVotes: 0
    },
    mounted: function() {
        <?php foreach ($candidates as $candidate) { ?>
            this.candidates[<?php echo $candidate->id; ?>] = '<?php echo $candidate->pair_name; ?>';
            this.targetVotes[<?php echo $candidate->id; ?>] = <?php echo $votes[$candidate->id]; ?>;
            this.currentVotes[<?php echo $candidate->id; ?>] = 0;
        <?php } ?>

        var tempMax = 1;
        for (var i = 1; i < this.targetVotes.length; i++) {
            if (this.targetVotes[i] > this.targetVotes[tempMax]) {
                tempMax = i;
            }
        }

        this.maxVotes = tempMax;
    },
    methods: {
        startCounting: function() {
            if (this.timer == null) {
                this.timer = window.setInterval(this.onCounterTimerElapsed.bind(this), 15);
                this.countingStarted = true;
                window.location.href = '#results-page';
            }
        },
        onCounterTimerElapsed: function() {
            if (this.currentVotes[this.maxVotes] == this.targetVotes[this.maxVotes]) {
                window.clearInterval(this.timer);
                this.timer = null;
            }

            <?php foreach ($candidates as $candidate) { ?>
                if (this.currentVotes[<?php echo $candidate->id; ?>] < this.targetVotes[<?php echo $candidate->id; ?>]) {
                    this.currentVotes[<?php echo $candidate->id; ?>]++;
                }
            <?php } ?>
            this.$forceUpdate();
        }
    }
});

</script>
