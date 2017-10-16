<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div id="droppable_zone">
                    <h4 class="draggable_item" :data-index="index" :style="'top:' + title.position_x + 'px;left:' + title.position_y + 'px;'" v-for="(title, index) in titles">
                        {{ title.name }}
                        <input :id="'position_' + index" type="hidden" :name="'position['+ index +']'" :value="title.position_x +','+ title.position_y">
                        <input type="hidden" :name="'nom['+ index +']'" :value="title.name">
                    </h4>
                    <img :src="path" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="name" placeholder="Titre">
                        <span class="input-group-btn">
                            <button @click="addTitle" class="btn btn-default" type="button">Ajouter!</button>
                        </span>
                    </div><!-- /input-group -->
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    #droppable_zone{
        width:auto;
        background:#f5f5f5;
        display:inline-block;
        position:relative;
    }
    .draggable_item{
        position:absolute;
        color:#c80e0a;
        font-weight:600;
        text-shadow:-1px -1px 0 #fff,1px -1px 0 #fff,-1px 1px 0 #fff,1px 1px 0 #fff;
    }
</style>
<script>
    export default {
        props: ['path'],
        data(){
            return{
                titles:[{ name: 'Besiztgericht', position_x :10, position_y: 20 }],
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
                        create: function( event, ui ) {}
                    });
                });
            },
            addTitle: function(){
                this.titles.push({ name: this.name, position_x :0, position_y: 0 });
                this.name = '';

                this.$nextTick(() => {
                    $('.draggable_item').draggable({
                        create: function( event, ui ) {}
                    });
                });
            },
        },

    }
</script>
