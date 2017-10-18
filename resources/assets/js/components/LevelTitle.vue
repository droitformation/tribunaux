<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div id="map-container">
                    <div id="droppable_zone">

                        <h4 class="draggable_item" :data-index="title.id" :style="'top:' + title.position.x + 'px;left:' + title.position.y + 'px;'" v-for="title in titles">
                            {{ title.nom }}
                            <input :id="'position_' + title.id" type="hidden" :name="'position['+ title.id +']'" :value="title.position.x +','+ title.position.y">
                            <input type="hidden" :name="'id['+ title.id +']'" :value="title.id">
                            <input type="hidden" name="type" :value="title.type">
                        </h4>

                        <img :src="path" />
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>

        </div>
    </div>
</template>
<style>
    #droppable_zone{
        width: 100%;
        background: #f5f5f5;
        display: inline-block;
        position: relative;
        text-align: center;
    }
    .draggable_item{
        position: absolute;
        color: #c9100c;
        font-weight: 600;
        font-size: 15px;
        text-shadow: -0.6px -0.6px 0 #fff,0.6px -0.6px 0 #fff,-0.6px 0.6px 0 #fff,0.6px 0.6px 0 #fff;
        white-space: nowrap;
        max-width: 150px;
        word-wrap: break-word;
        z-index: 1000;
        cursor: move;
    }
    .ui-draggable.ui-draggable-dragging {
        white-space: nowrap;
        max-width: 150px;
        word-wrap: break-word;
    }
</style>
<script>
    export default {
        props: ['path','titles'],
        data(){
            return{
                name: '',
            }
        },
        mounted: function ()  {
            this.prepare();
        },
        methods: {
            prepare : function(){

               this.$nextTick(function(){
                    $( "#droppable_zone" ).droppable({
                        drop: function( event, ui ) {
                            var index = ui.draggable.data('index');
                            var $input = $('#position_'+index);
                            console.log(index);
                            $input.val(ui.position.top +','+ui.position.left);
                        }
                    });
                    $( ".draggable_item" ).draggable({
                        cursor: "crosshair",
                        create: function( event, ui ) {}
                    });
                });
            },
            addTitle: function(){
                this.titles.push({ name: this.name, position_x :0, position_y: 0 });
                this.name = '';

                this.$nextTick(() => {
                    $('.draggable_item').draggable({
                        cursor: "crosshair",
                        create: function( event, ui ) {}
                    });
                });
            },
        },

    }
</script>
