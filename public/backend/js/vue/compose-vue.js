
var dropTo = '';
var _ = Vue.util;

Vue.directive('draggable', {
    bind: function() {
        this.data = {};
        var self = this;
        this.dragstart = function(event) {
            dropTo = self.arg;
            event.target.classList.add(self.data.dragged);
            event.dataTransfer.effectAllowed = 'all';
            event.dataTransfer.setData('data', JSON.stringify(self.data));
            event.dataTransfer.setData('tag', self.arg);
            return false;
        };
        this.dragend = function(event) {
            event.target.classList.remove(self.data.dragged);
            return false;
        };
        this.el.setAttribute('draggable', true);
        _.on(this.el, 'dragstart', this.dragstart);
        _.on(this.el, 'dragend', this.dragend);
    },
    unbind: function() {
        this.el.setAttribute('draggable', false);
        _.off(this.el, 'dragstart', this.dragstart);
        _.off(this.el, 'dragend', this.dragend);
    },
    update: function(value, old) {
        this.data = value;
    }
});

Vue.directive('dropzone', {
    acceptStatement: true,
    bind: function() {
        var self = this;
        this.dragenter = function(event) {
            if (dropTo == self.arg) {
                event.target.classList.add(self.arg);
            }
            return false;
        };
        this.dragover = function(event) {
            if (event.preventDefault) {
                event.preventDefault();
            }
            // XXX
            if (dropTo == self.arg) {
                event.dataTransfer.effectAllowed = 'all';
                event.dataTransfer.dropEffect = 'copy';
            } else {
                event.dataTransfer.effectAllowed = 'none';
                event.dataTransfer.dropEffect = 'none';
            }
            return false;
        };
        this.dragleave = function(event) {
            if (dropTo == self.arg) {
                event.target.classList.remove(self.arg);
            }
            return false;
        };
        this.drop = function(event) {
            if (event.preventDefault) {
                event.preventDefault();
            }
            var tag = event.dataTransfer.getData('tag');
            var data = event.dataTransfer.getData('data');
            if (dropTo == self.arg) {
                self.handler(tag, JSON.parse(data));
                event.target.classList.remove(self.arg);
            }
            return false;
        };
        _.on(this.el, 'dragenter', this.dragenter);
        _.on(this.el, 'dragleave', this.dragleave);
        _.on(this.el, 'dragover', this.dragover);
        _.on(this.el, 'drop', this.drop);
    },
    unbind: function() {
        _.off(this.el, 'dragenter', this.dragenter);
        _.off(this.el, 'dragleave', this.dragleave);
        _.off(this.el, 'dragover', this.dragover);
        _.off(this.el, 'drop', this.drop);
    },
    update: function(value, old) {
        var vm = this.vm;
        this.handler = function(tag, data) {
            vm.$droptag = tag;
            vm.$dropdata = data;
            var res = value(tag, data);
            vm.$droptag = null;
            vm.$dropdata = null;
            return res;
        };
    },
});


new Vue({

    el: '#compose',

    data: {
        boxes: [
            {
                id: 1,
                text: 'Learn JavaScript',
                width:100,
                height:120 ,
                top:10,
                left:30
            },
            {
                id: 2,
                text: 'Learn PHP',
                width:110,
                height:80 ,
                top:40,
                left:150
            }
        ],

        newBox: ''
    },

    ready: function(){

        var self = this;
/*
        this.boxes.forEach(function(box)
        {
            var current = 'box_' + box.id;

            $('#'+current).draggable({
                grid: [ 10,10 ],
                containment: 'parent',
                start: function() {},
                drag: function( event, ui ) {},
                stop: function(event, ui)
                {
                    self.updateCoordinates(ui);
                }
            });
        });*/
    },

    methods: {

        createBox: function(){

            var data = {
                method : 'PUT' , _token: $("meta[name='_token']").attr('content') ,
                width  : 100,
                height : 100,
                top    : 0,
                left   : 0
            };

            var self = this;

            $.ajax({
                type: "POST",
                data: data,
                url: "/box",
                success: function(result) {

                    self.boxes.push({
                        id: result.id, left  : 0, top   : 0, width : 100, height: 100
                    });
                }
            });

        },

        updateCoordinates: function(box){

            // Get the new values
            var id        =  box.helper.attr('id');
            var position  =  box.helper.position();
            var width     =  box.helper.width();
            var height    =  box.helper.height();

            var id = id.replace("box_", "");

            var data = {
                method : 'PUT' , _token: $("meta[name='_token']").attr('content') ,
                id     : id,
                width  : width,
                height : height,
                top    : position.top,
                left   : position.left
            };

            $.ajax({
                type: "POST",
                data: data,
                url: "/box/"+id,
                success: function(result) {
                    console.log(result);
                }
            });
        },

        move: function(from, to, id, tag, data) {
            /*var tmp = from[data.index];
            from.splice(data.index, 1);
            to.splice(id, 0, tmp);*/

            console.log('moved:'+tag);
        },
        remove: function(from, tag, data) {
            from.splice(data.index, 1);
        }

    }

});