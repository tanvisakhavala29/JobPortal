// Minimal element SDK stub used by the app for theme/config editing
(function () {
  window.elementSdk = {
    config: {},
    init(options) {
      this._options = options || {};
      this.config =
        options && options.defaultConfig ? options.defaultConfig : {};
      if (options && typeof options.onConfigChange === "function") {
        options.onConfigChange(this.config);
      }
    },
    setConfig(cfg) {
      this.config = Object.assign({}, this.config, cfg);
      if (this._options && typeof this._options.onConfigChange === "function")
        this._options.onConfigChange(this.config);
    },
  };
})();
