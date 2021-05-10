var exampleComponent = {
  template: '<div>
Component examples
</div>'
};

new Vue({
  el: '#app',
  components: {
    'example': exampleComponent
  },
  data: {
      posts: []
  },
  methods: {
  }
});