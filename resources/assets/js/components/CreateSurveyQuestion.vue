<template>

    <div class="box has-text-dark">
        <strong>Add A Question</strong>
        <div class="field">
            <p class="control">
                <input class="input" type="text" placeholder="Question" v-model="question.question">
            </p>
        </div>
        <strong>Options:</strong>
        <template v-if="optionCount < 1">
            Add options
        </template>
        <template v-else>
            <ul>
                <li v-for="option in question.options">
                    {{ option }}
                    <span class="u-margin-left u-button-like" @click="removeOption(option)">
                        <i class="fa fa-minus-circle"></i>
                    </span>
                </li>
            </ul>
        </template>

        <div class="field">
            <div class="field u-inline">
                <p class="control">
                    <input class="input" type="text" placeholder="Answer"
                           v-model="option">
                </p>
                <span class="u-margin-left u-button-like" @click="addOption">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
        </div>

        <button class="button is-primary" @click="saveQuestion">Save</button>
    </div>

</template>

<script>

  export default {

    name: 'SurveyQuestion',

    data() {
      return {
        question: {
          question: '',
          options: []
        },
        option: ''
      }
    },

    computed: {

      optionCount() {
        return this.question.options.length;
      }

    },

    methods: {

      addOption() {
        this.question.options.push(this.option);
        this.option = '';
      },

      removeOption(option) {
        let index = this.question.options.indexOf(option);
        this.question.options.splice(index, 1);

      },

      saveQuestion() {
        AppEvents.$emit('save-question', this.question);
      }
    }

  }

</script>