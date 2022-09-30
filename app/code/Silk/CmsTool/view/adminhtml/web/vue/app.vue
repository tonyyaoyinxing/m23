<template>
    <div id="app">
        <div class="list" id="list">
            <vue-drag-resize v-for="(rect, index) in element"
                           :key="index"
                           :w="rect.width"
                           :h="rect.height"
                           :x="rect.left"
                           :y="rect.top"
                           :parentW="listWidth"
                           :parentH="listHeight"
                           :axis="rect.axis"
                           :isActive="rect.active"
                           :minw="rect.minw"
                           :minh="rect.minh"
                           :isDraggable="rect.draggable"
                           :isResizable="rect.resizable"
                           :parentLimitation="rect.parentLim"
                           :snapToGrid="rect.snapToGrid"
                           :aspectRatio="rect.aspectRatio"
                           :z="rect.zIndex"
                           :contentClass="rect.class"
                           v-on:activated="activateEv(index)"
                           v-on:deactivated="deactivateEv(index)"
                           v-on:dragging="changePosition($event, index)"
                           v-on:resizing="changeSize($event, index)"
            >
                <div class="filler" :style="{backgroundColor:rect.color}"></div>
            </vue-drag-resize>
        </div>

    </div>
</template>

<script>
    define([
        'Vue',
        'uuid'
    ], function(Vue, uuid) {
        Vue.component('cmstool-block', {
            props: {
                element: {
                    type: Array,
                    required: true
                },
                config: {
                    type: Object,
                    required: true
                }
            },
            methods: {
                uuid,
                setSelectedNode: function(item) {
                    this.selectedItem = item;
                },
                removeNode: function(list, index) {
                    list.splice(index, 1);
                },
                addNode: function(target) {
                    target.push({
                        id: this.uuid(),
                        uuid: this.uuid(),
                        type: 'category',
                        title: this.config.translation.addNode,
                        content: null,
                        image: null,
                        image_alt_text: '',
                        node_template: null,
                        submenu_template: null,
                        columns: [],
                        is_active: 0
                    });
                },
                addImage: function(target) {
                    target.push({
                        id: this.uuid(),
                        uuid: this.uuid(),
                        type: 'category',
                        title: this.config.translation.addImage,
                        content: null,
                        image: null,
                        image_alt_text: '',
                        node_template: null,
                        submenu_template: null,
                        columns: [],
                        is_active: 0
                    });
                },
                addText: function(target) {
                    target.push({
                        id: this.uuid(),
                        uuid: this.uuid(),
                        type: 'category',
                        title: this.config.translation.addText,
                        content: null,
                        image: null,
                        image_alt_text: '',
                        node_template: null,
                        submenu_template: null,
                        columns: [],
                        is_active: 0
                    });
                },
                addVideo: function(target) {
                    target.push({
                        id: this.uuid(),
                        uuid: this.uuid(),
                        type: 'category',
                        title: this.config.translation.addVideo,
                        content: null,
                        image: null,
                        image_alt_text: '',
                        node_template: null,
                        submenu_template: null,
                        columns: [],
                        is_active: 0
                    });
                },
                handleDrop(data) {
                    data.item.uuid = this.uuid();
                    data.list.splice(data.index, 0, data.item);
                },
                updateSerializedNodes(value) {
                    const updateEvent = new Event('change');
                    const serializedNodeInput = document.querySelector('[name="serialized_nodes"]');
                    // update serialized_nodes input value
                    serializedNodeInput.value = value;
                    // trigger change event to set value
                    serializedNodeInput.dispatchEvent(updateEvent);
                }
            },
            template: template
        });
    });
</script>
