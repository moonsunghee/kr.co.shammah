/* quote.js – Client-side form validation */
document.addEventListener('DOMContentLoaded', function () {
  var form = document.querySelector('.quote-form');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    var errors = [];
    var name = form.querySelector('[name="client_name"]');
    var phone = form.querySelector('[name="phone"]');
    var email = form.querySelector('[name="email"]');
    var checkboxes = form.querySelectorAll('[name="service_types[]"]:checked');
    var desc = form.querySelector('[name="description"]');
    var privacy = form.querySelector('[name="privacy_agree"]');

    if (name && !name.value.trim()) errors.push('의뢰인명을 입력해주세요.');
    if (phone && !phone.value.trim()) errors.push('연락처를 입력해주세요.');
    if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) errors.push('올바른 이메일 주소를 입력해주세요.');
    if (checkboxes.length === 0) errors.push('의뢰 종류를 하나 이상 선택해주세요.');
    if (desc && !desc.value.trim()) errors.push('프로젝트 설명을 입력해주세요.');
    if (privacy && !privacy.checked) errors.push('개인정보 처리방침에 동의해주세요.');

    if (errors.length > 0) {
      e.preventDefault();
      var existing = form.parentElement.querySelector('.alert--error');
      if (existing) existing.remove();

      var alertDiv = document.createElement('div');
      alertDiv.className = 'alert alert--error';
      var ul = document.createElement('ul');
      errors.forEach(function (msg) {
        var li = document.createElement('li');
        li.textContent = msg;
        ul.appendChild(li);
      });
      alertDiv.appendChild(ul);
      form.parentElement.insertBefore(alertDiv, form);
      alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });
});
