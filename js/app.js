(function () {
  const toggler = document.querySelector('.navbar-toggler');
  const menu = document.querySelector('#mainNavbar');

  if (toggler && menu) {
    const isShown = () => menu.classList.contains('show');

    const setExpanded = (expanded) => {
      toggler.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    };

    toggler.addEventListener('click', function () {
      menu.classList.toggle('show');
      setExpanded(isShown());
    });

    menu.querySelectorAll('.nav-link').forEach((link) => {
      link.addEventListener('click', function () {
        if (window.innerWidth < 992 && isShown()) {
          menu.classList.remove('show');
          setExpanded(false);
        }
      });
    });
  }

  const leaderboardList = document.getElementById('leaderboard-list');
  if (!leaderboardList) return;

  const searchInput = document.getElementById('leaderboard-search');
  const sortButtons = document.querySelectorAll('[data-sort]');
  const toggleBtn = document.getElementById('leaderboard-toggle');
  const followed = new Set();
  let currentSort = 'score';

  // داده‌ها از HTML (که با PHP ساخته شده) خوانده می‌شوند.
  const users = Array.from(leaderboardList.querySelectorAll('.leaderboard-item')).map((item) => ({
    id: Number(item.dataset.id),
<<<<<<< HEAD
<<<<<<< HEAD
    username: item.dataset.username,
    score: Number(item.dataset.score),
    element: item
  }));
=======
=======
>>>>>>> f0193c4b4b7819546b749509336b48dde2741f62
    username: (item.dataset.username || '').trim(),
    usernameLower: (item.dataset.username || '').trim().toLowerCase(),
    score: Number(item.dataset.score),
    element: item
  }));

  const byScore = (a, b) => {
    if (b.score !== a.score) return b.score - a.score;
    const nameCompare = a.username.localeCompare(b.username, 'en', { sensitivity: 'base' });
    if (nameCompare !== 0) return nameCompare;
    return a.id - b.id;
  };

  const byName = (a, b) => {
    const nameCompare = a.username.localeCompare(b.username, 'en', { sensitivity: 'base' });
    if (nameCompare !== 0) return nameCompare;
    if (b.score !== a.score) return b.score - a.score;
    return a.id - b.id;
  };
>>>>>>> 12d1e673516116321fd1008f3a1e1cb7736c43ce

  const renderList = () => {
    const query = (searchInput.value || '').trim().toLowerCase();

    const visibleUsers = users
<<<<<<< HEAD
<<<<<<< HEAD
      .filter((user) => user.username.includes(query))
      .sort((a, b) => {
        if (currentSort === 'name') return a.username.localeCompare(b.username);
        return b.score - a.score;
      });
=======
      .filter((user) => user.usernameLower.includes(query))
      .sort((a, b) => (currentSort === 'name' ? byName(a, b) : byScore(a, b)));
>>>>>>> 12d1e673516116321fd1008f3a1e1cb7736c43ce
=======
      .filter((user) => user.usernameLower.includes(query))
      .sort((a, b) => (currentSort === 'name' ? byName(a, b) : byScore(a, b)));
>>>>>>> f0193c4b4b7819546b749509336b48dde2741f62

    leaderboardList.innerHTML = '';

    visibleUsers.forEach((user, index) => {
      const clonedItem = user.element.cloneNode(true);
      clonedItem.classList.toggle('top', index === 0);
      clonedItem.querySelector('strong').textContent = `#${index + 1}`;

      const followBtn = clonedItem.querySelector('.follow-btn');
      const isFollowed = followed.has(user.id);
      followBtn.textContent = isFollowed ? 'Unfollow' : 'Follow';
      followBtn.classList.toggle('btn-info', isFollowed);
      followBtn.classList.toggle('btn-outline-light', !isFollowed);
      followBtn.setAttribute('aria-label', `${isFollowed ? 'لغو دنبال کردن' : 'دنبال کردن'} ${user.username}`);

      leaderboardList.appendChild(clonedItem);
    });
  };

  searchInput.addEventListener('input', renderList);

  sortButtons.forEach((button) => {
    button.addEventListener('click', function () {
      currentSort = this.dataset.sort;
      sortButtons.forEach((btn) => btn.classList.replace('btn-info', 'btn-outline-info'));
      this.classList.remove('btn-outline-info');
      this.classList.add('btn-info');
      renderList();
    });
  });

  // دکمه دنبال کردن برای هر کاربر با event delegation
  leaderboardList.addEventListener('click', function (event) {
    const target = event.target.closest('.follow-btn');
    if (!target) return;

    const userId = Number(target.dataset.id);
    if (followed.has(userId)) {
      followed.delete(userId);
    } else {
      followed.add(userId);
    }

    renderList();
  });

  if (toggleBtn) {
    toggleBtn.addEventListener('click', function () {
      const expanded = this.getAttribute('aria-expanded') === 'true';
      this.setAttribute('aria-expanded', expanded ? 'false' : 'true');
      this.textContent = expanded ? 'نمایش' : 'بستن';
      leaderboardList.classList.toggle('leaderboard-open');
    });
  }

  renderList();
})();
