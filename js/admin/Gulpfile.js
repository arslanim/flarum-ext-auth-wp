var gulp = require('flarum-gulp');

gulp({
  modules: {
    'arslanim/auth/wp': [
      'src/**/*.js'
    ]
  }
});