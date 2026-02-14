import { createElement } from 'react';
import { createRoot } from 'react-dom/client';
import { Agentation } from 'agentation';

document.addEventListener('DOMContentLoaded', () => {
  const el = document.getElementById('agentation-root');
  if (!el) return;

  const props = {};
  if (el.dataset.endpoint) {
    props.endpoint = el.dataset.endpoint;
  }

  createRoot(el).render(createElement(Agentation, props));
});
