// Simple localStorage-backed data SDK for JobPortal (no database)
(function () {
  const STORAGE_KEY = "jobportal_records_v1";
  const ID_KEY = "jobportal_next_id_v1";

  function load() {
    const raw = localStorage.getItem(STORAGE_KEY);
    return raw ? JSON.parse(raw) : [];
  }

  function save(records) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(records));
  }

  function nextId() {
    const n = parseInt(localStorage.getItem(ID_KEY) || "1", 10);
    localStorage.setItem(ID_KEY, String(n + 1));
    return String(n);
  }

  function asyncResult(ok = true, payload = {}) {
    return new Promise((resolve) =>
      setTimeout(() => resolve({ isOk: ok, ...payload }), 120)
    );
  }

  window.dataSdk = {
    async init(handler) {
      this._handler = handler;
      this._records = load();
      // ensure ids for older records
      this._records.forEach((r) => {
        if (!r.__backendId) r.__backendId = nextId();
      });
      save(this._records);
      if (handler && typeof handler.onDataChanged === "function") {
        handler.onDataChanged(this._records.slice());
      }
      return asyncResult(true, { isOk: true });
    },

    async list() {
      this._records = load();
      return asyncResult(true, { records: this._records.slice() });
    },

    async create(record) {
      const r = Object.assign({}, record);
      r.__backendId = nextId();
      this._records = load();
      this._records.push(r);
      save(this._records);
      if (this._handler && typeof this._handler.onDataChanged === "function")
        this._handler.onDataChanged(this._records.slice());
      return asyncResult(true, { record: r });
    },

    async update(record) {
      this._records = load();
      const idx = this._records.findIndex(
        (r) => r.__backendId === record.__backendId
      );
      if (idx === -1) return asyncResult(false);
      this._records[idx] = Object.assign({}, this._records[idx], record);
      save(this._records);
      if (this._handler && typeof this._handler.onDataChanged === "function")
        this._handler.onDataChanged(this._records.slice());
      return asyncResult(true, { record: this._records[idx] });
    },

    async delete(record) {
      this._records = load();
      const idx = this._records.findIndex(
        (r) => r.__backendId === record.__backendId
      );
      if (idx === -1) return asyncResult(false);
      this._records.splice(idx, 1);
      save(this._records);
      if (this._handler && typeof this._handler.onDataChanged === "function")
        this._handler.onDataChanged(this._records.slice());
      return asyncResult(true);
    },
  };
})();
