<template>

    <div class="box has-text-dark">
        <strong>Add A Question</strong>
        <div class="field">
            <p class="control">
                <input class="input" type="text" placeholder="Question" v-model="question.question">
            </p>
        </div>
        <strong>Options:</strong>

        <ul>
            <li v-for="option in question.options">
                {{ option }}
                <span class="u-margin-left u-button-like" @click="removeOption(option)">
                    <i class="fa fa-minus-circle"></i>
                </span>
            </li>
        </ul>

        <div class="field">
            <div class="field u-inline">
                <p class="control">
                    <input class="input" type="text" placeholder="Answer" v-model="option.label">
                </p>
                <p class="control" v-if="showValue">
                    <input class="input" type="text" placeholder="Answer" v-model="option.value">
                </p>
                <span class="u-margin-left u-button-like" @click="addOption">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <p class="control">
                <input type="checkbox" v-model="showValue"> Add Score or Value
            </p>
        </div>

        <div v-if="disableSave" class="alert alert--warning">
            Please Add at least 2 options.
        </div>

        <button class="button is-primary" @click="saveQuestion" :disabled="disableSave">Save</button>
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
        option: {
          label: '',
          value: ''
        },
        showValue: false
      }
    },

    computed: {

      optionCount() {
        return this.question.options.length;
      },

      disableSave() {
        // don't allow to save unless more than 1 option created
        return this.optionCount < 2 || !this.question.question
      }

    },

    methods: {

      addOption() {
        this.question.options.push(this.option);
        this.option =  {
          label: '',
          value: ''
        }
      },

      removeOption(option) {
        let index = this.question.options.indexOf(option);
        this.question.options.splice(index, 1);

      },

      saveQuestion() {
        AppEvents.$emit('save-question', this.question);
        this.question = {
          question: '',
          options: []
        }
      }

    }
  }

</script>