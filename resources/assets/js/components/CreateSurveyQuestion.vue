<template>
    <div class="box has-text-dark">
        <strong class="is-required">Add A Question</strong>
        <div class="field">
            <p class="control">
                <input class="input" type="text" placeholder="Question" v-model="question.question">
            </p>
        </div>
        <strong>Options:</strong>

        <ul>
            <li v-for="option in question.options">
                {{ option.label }}
                <template v-if="option.value">({{ option.value }})</template>
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
            <span v-if="errors[optionErrorName]" class="help-block">{{ errors[optionErrorName] }}</span>
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
          idx: 0,
          question: '',
          options: [],
        },
        option: {
          idx: 0,
          label: '',
          value: ''
        },
        showValue: false,
        errors: {},
        //one-directional incrementing counter for questions to deal with errors
        cnt: 0,
      }
    },

    computed: {

      optionCount() {
        return this.question.options.length;
      },

      optionErrorName() {
          let i = this.question.options.length;
          return 'q-'+this.cnt+'-opt-error-'+i;
      },

      disableSave() {
        // don't allow to save unless more than 1 option created
        return this.optionCount < 2 || !this.question.question
      }

    },

    methods: {
      addError(text) {
        let name = this.optionErrorName;
        this.$set(this.errors, name, text);
      },

      remError() {
        let name = this.optionErrorName;
        this.$delete(this.errors, name);
      },

      emptyOption() {
        let i = this.question.options.length
        this.option = {
          idx: i,
          label: '',
          value: ''
        }
      },

      emptyQuestion(i) {
        this.question = {
          idx: i+1,
          question: '',
          options: []
        }
        this.emptyOption();
      },

      checkNewOption() {
        this.option.label = this.option.label.trim();
        if (!this.option.label){
            this.addError('Option label can not be blank.');
            return false;
        } else {
            let opts = this.question.options;
            for (var i=0, len = this.optionCount; i < len; i++) {
                if (opts[i].label == this.option.label){
                    this.addError('Option labels must be unique per question.');
                    return false;
                }
            }
        }
        return true;
      },

      addOption() {
        if (this.checkNewOption()){
            this.remError();
            this.question.options.push(this.option);
            this.emptyOption();
        } else {
            return false;
        }

      },

      removeOption(option) {
        let index = this.question.options.indexOf(option);
        this.question.options.splice(index, 1);
      },

      saveQuestion() {
        AppEvents.$emit('save-question', this.question);
        this.cnt++;
        this.emptyQuestion();
      },

    }
  }
</script>
