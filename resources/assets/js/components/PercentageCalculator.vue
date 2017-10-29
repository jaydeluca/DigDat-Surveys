<template>
    <span>
        ({{ result }}%)
    </span>
</template>

<script>

  export default {
    props: ['count', 'total'],
    computed: {
      result() {
        if (this.total && this.total > 0) {
          return Math.round((this.count / this.total) * 100);
        }
        return 0;
      },
    }
  }
</script>
