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

  const users = [
    { id: 1, username: 'AstraVex', rank: 1, score: 99340, country: 'USA', flag: '🇺🇸', badges: ['pro', 'mvp'], online: true, avatar: 'https://i.pravatar.cc/80?img=11' },
    { id: 2, username: 'KitsuneZero', rank: 2, score: 98110, country: 'Japan', flag: '🇯🇵', badges: ['pro'], online: false, avatar: 'https://i.pravatar.cc/80?img=12' },
    { id: 3, username: 'Frostbyte77', rank: 3, score: 96700, country: 'Canada', flag: '🇨🇦', badges: ['mod'], online: true, avatar: 'https://i.pravatar.cc/80?img=13' },
    { id: 4, username: 'NyxRogue', rank: 4, score: 95335, country: 'UK', flag: '🇬🇧', badges: ['pro'], online: true, avatar: 'https://i.pravatar.cc/80?img=14' },
    { id: 5, username: 'EchoVolt', rank: 5, score: 94215, country: 'Germany', flag: '🇩🇪', badges: ['mod'], online: false, avatar: 'https://i.pravatar.cc/80?img=15' },
    { id: 6, username: 'RaptorN1', rank: 6, score: 93890, country: 'Brazil', flag: '🇧🇷', badges: ['pro'], online: true, avatar: 'https://i.pravatar.cc/80?img=16' },
    { id: 7, username: 'LunaCipher', rank: 7, score: 92540, country: 'France', flag: '🇫🇷', badges: ['vip'], online: false, avatar: 'https://i.pravatar.cc/80?img=17' },
    { id: 8, username: 'StormSpectre', rank: 8, score: 91870, country: 'Australia', flag: '🇦🇺', badges: ['pro', 'mod'], online: true, avatar: 'https://i.pravatar.cc/80?img=18' },
    { id: 9, username: 'PixelSage', rank: 9, score: 90510, country: 'Sweden', flag: '🇸🇪', badges: ['vip'], online: true, avatar: 'https://i.pravatar.cc/80?img=19' },
    { id: 10, username: 'NeoTitan', rank: 10, score: 89125, country: 'South Korea', flag: '🇰🇷', badges: ['pro'], online: false, avatar: 'https://i.pravatar.cc/80?img=20' },
    { id: 11, username: 'HexaDruid', rank: 11, score: 88190, country: 'India', flag: '🇮🇳', badges: ['mod'], online: true, avatar: 'https://i.pravatar.cc/80?img=21' }
  ];

  const leaderboardList = document.getElementById('leaderboard-list');
  if (!leaderboardList) return;

  const searchInput = document.getElementById('leaderboard-search');
  const sortButtons = document.querySelectorAll('[data-sort]');
  const toggleBtn = document.getElementById('leaderboard-toggle');
  const followed = new Set([1]);
  let currentSort = 'rank';

  const sortedAndFiltered = () => {
    const query = (searchInput.value || '').trim().toLowerCase();

    return users
      .filter((user) => user.username.toLowerCase().includes(query) || user.country.toLowerCase().includes(query))
      .sort((a, b) => {
        if (currentSort === 'score') return b.score - a.score;
        if (currentSort === 'name') return a.username.localeCompare(b.username);
        return a.rank - b.rank;
      })
      .slice(0, 10);
  };

  const createUserItem = (user, index) => {
    const item = document.createElement('li');
    item.className = `leaderboard-item ${index === 0 ? 'top' : ''}`;

    const badgeHtml = user.badges.map((badge) => `<span class="badge-chip">${badge}</span>`).join('');
    const isFollowed = followed.has(user.id);

    item.innerHTML = `
      <strong class="text-info">#${user.rank}</strong>
      <img class="leaderboard-avatar" src="${user.avatar}" alt="آواتار ${user.username}" loading="lazy">
      <div class="leaderboard-meta">
        <div class="leaderboard-user">${user.username}</div>
        <small class="text-secondary">${user.flag} ${user.country} · ${user.score.toLocaleString()} امتیاز</small>
        <div class="mt-1">${badgeHtml}<span class="status-dot ${user.online ? 'online' : 'offline'}" title="${user.online ? 'online' : 'offline'}"></span></div>
      </div>
      <button class="btn btn-sm ${isFollowed ? 'btn-info' : 'btn-outline-light'} follow-btn" data-id="${user.id}" aria-label="${isFollowed ? 'لغو دنبال کردن' : 'دنبال کردن'} ${user.username}">${isFollowed ? 'Unfollow' : 'Follow'}</button>
    `;

    return item;
  };

  const renderList = () => {
    leaderboardList.innerHTML = '';
    sortedAndFiltered().forEach((user, index) => leaderboardList.appendChild(createUserItem(user, index)));
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
