<template>
  <div>
    <div id="side">
      <div class="fields">Textbox</div>
      <div class="fields">Checkbox</div>
      <div class="fields">Radio Button</div>
      <hr />
      <div>x: {{ currentField.x }}</div>
      <div>y: {{ currentField.y }}</div>
      <div>w: {{ currentField.width }}</div>
      <div>h: {{ currentField.height }}</div>
      <div>index: {{ currentFieldIndex }}</div>
      <hr />
      <button @click="setFieldProperties">Set Field Properties</button>
    </div>
    <div id="page-container">
      <div
        v-for="p in pages"
        class="page"
        :style="{ width: p.width + 'px', height: p.height + 'px' }"
      >
        <vue-drag-resize
          @clicked="onActivated(index);"
          @activated="onActivated(index);"
          @dragstop="onDragStop"
          @resizestop="onResizeStop"
          :key="f.id"
          v-for="(f, index) in getFields(p.pageNumber)"
          class="field"
          :x="f.left"
          :y="f.top"
          :w="f.width"
          :h="f.height"
          :isActive="f.isActive"
        >
          {{ f.id }}
        </vue-drag-resize>
      </div>
    </div>
  </div>
</template>

<script>
import VueDragResize from "vue-drag-resize";

export default {
  data() {
    return {
      pages: [
        { pageNumber: 1, width: 500, height: 500 },
        { pageNumber: 2, width: 600, height: 500 },
        { pageNumber: 3, width: 550, height: 300 }
      ],
      fields: [
        {
          id: "001",
          pageNumber: 1,
          left: 100,
          top: 100,
          width: 200,
          height: 30,
          isActive: false
        },
        {
          id: "002",
          pageNumber: 1,
          left: 100,
          top: 200,
          width: 100,
          height: 30,
          isActive: false
        },
        {
          id: "003",
          pageNumber: 2,
          left: 400,
          top: 120,
          width: 50,
          height: 30,
          isActive: false
        }
      ],
      currentField: {},
      currentFieldIndex: null
    };
  },
  methods: {
    onActivated(index) {
      console.log(index);
      this.currentFieldIndex = index;
      this.currentField.left = this.fields[this.currentFieldIndex].left;
      this.currentField.top = this.fields[this.currentFieldIndex].top;
      console.log(this.currentFieldIndex);
    },
    onDragStop(rect) {
      console.log(rect);
      if (rect.left < 0 || rect.top < 0) {
        alert("revert!!");
        console.log(this.currentField.left);
        console.log(this.currentField.top);
        this.fields[this.currentFieldIndex].left = this.currentField.left;
        this.fields[this.currentFieldIndex].top = this.currentField.top;
      } else {
        this.fields[this.currentFieldIndex].left = rect.left;
        this.fields[this.currentFieldIndex].top = rect.top;
        this.currentField.x = rect.left;
        this.currentField.y = rect.top;
      }
    },
    onResizeStop(rect) {
      console.log(rect);
      this.fields[this.currentFieldIndex].left = rect.left;
      this.fields[this.currentFieldIndex].top = rect.top;
      this.fields[this.currentFieldIndex].width = rect.width;
      this.fields[this.currentFieldIndex].height = rect.height;
      this.currentField.x = rect.left;
      this.currentField.y = rect.top;
      this.currentField.width = rect.width;
      this.currentField.height = rect.height;
    },
    setFieldProperties() {
      if (this.currentFieldIndex !== null) {
        this.fields[this.currentFieldIndex].left = 10;
        this.fields[this.currentFieldIndex].top = 10;
        this.fields[this.currentFieldIndex].width = 100;
        this.fields[this.currentFieldIndex].height = 20;
      }
    },
    getFields(pageNumber) {
      var fields = [];
      for (var i = 0; i < this.fields.length; i++) {
        if (pageNumber === this.fields[i].pageNumber) {
          fields.push(this.fields[i]);
        }
      }
      return fields;
    }
  },
  components: {
    VueDragResize
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
#side {
  position: fixed;
  width: 250px;
  left: 0;
  bottom: 0;
  top: 0;
  padding: 15px;
  background-color: #eee;
  border-right: 1px solid #ccc;
}
#side div {
  border: 1px solid #ddd;
  background-color: #ffffff;
  padding: 10px;
  margin-bottom: 5px;
}
#page-container {
  margin-left: 300px;
}
.page {
  margin-top: 2px;
  margin-bottom: 2px;
  border: 1px solid black;
  position: relative;
  margin-left: auto;
  margin-right: auto;
}
.field {
  position: absolute;
  border: 1px solid #eee;
  background-color: #fe90ce;
  padding: 3px;
}
</style>
