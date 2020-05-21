<div id="vote-page" class="w3-padding-large">
    <div class="w3-cell-row w3-center">
        <?php foreach ($candidates as $candidate) { ?>
            <div class="w3-cell w3-padding-large">
                <div class="w3-card-4 w3-white">
                    <div class="w3-padding-large">
                        <h1><?php echo $candidate->id; ?></h1>
                    </div>
                    <div class="w3-display-container">
                        <div>
                            <img src="<?php echo base_url('public/img/candidate-'.$candidate->id.'.jpg'); ?>" class="w3-block" title="Pasangan <?php echo $candidate->id; ?>" width="350px" height="225px">
                        </div>
                        <div v-if="chosen == <?php echo $candidate->id; ?>" class="w3-display-bottommiddle">
                            <div class="w3-padding">
                                <div class="w3-card w3-round w3-yellow">
                                    <b class="w3-padding">Terpilih</b>
                                </div>
                            </div>
                        </div>
                        <div class="w3-display-hover">
                            <div style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.4)"></div>
                            <div class="w3-display-middle">
                                <div v-if="chosen == 0 || chosen != <?php echo $candidate->id; ?>">
                                    <button class="w3-btn w3-theme-action w3-xlarge w3-card-4" v-on:click="chose(<?php echo $candidate->id; ?>)">Pilih</button>
                                </div>
                                <div v-if="chosen == <?php echo $candidate->id; ?>">
                                    <button class="w3-btn w3-yellow w3-xlarge w3-card-4" disabled>Terpilih</button>
                                </div>
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
        <div id="done" class="w3-padding">
            <p class="w3-large" v-if="chosen != 0">Terpilih: <b>#{{ chosen }}: {{ candidates[chosen] }}</b></p>
            <p class="w3-large" v-if="chosen == 0">Silakan pilih salah satu</p>
            <?php echo form_open('user/vote', 'onsubmit="return confirm(\'Apakah anda yakin?\')"'); ?>
                <input type="hidden" name="vote_id" v-model="chosen">
                <input type="submit" class="w3-btn w3-theme-action" v-bind:disabled="chosen == 0" value="Selesai">
            </form>
        </div>
    </div>
</div>

<script>

var votePage = new Vue({
    el: '#vote-page',
    data: {
        chosen: 0,
        candidates: []
    },
    mounted: function() {
        <?php foreach ($candidates as $candidate) { ?>
            this.candidates[<?php echo $candidate->id; ?>] = '<?php echo $candidate->pair_name; ?>';
        <?php } ?>
    },
    methods: {
        chose: function(id) {
            this.chosen = id;
            window.location.href = '#done';
        }
    }
});

</script>
