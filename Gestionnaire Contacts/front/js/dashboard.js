//const axios = require('axios');


function buildDashboard() {
  buildContactsStats();
}

function buildContactsStats() {

  axios.get('http://localhost:3123/contacts').then(resp => {

    // Initialize JS object "stats"
    let nbChildren = resp.data[0].children.length,
        nbFriends = resp.data[0].friends.length,
        age = new Date( Date.now() - new Date(resp.data[0].birthdate) ).getFullYear() - 1970,
        stats = {
          "nbContacts": resp.data.length,
          "active": 0,
          "gender": { "male": 0, "female": 0 },
          "age": { "min": age, "avg": age, "max": age },
          "children": { "min": nbChildren, "avg": nbChildren, "max": nbChildren },
          "drvLicenses": { "A": 0, "B": 0, "C": 0, "D": 0 },
          "friends": { "min": nbFriends, "avg": nbFriends, "max": nbFriends },
          "balance": { "min": 0, "avg": 0, "max": 0, "sum": 0 }
        },
        sumAge = 0,
        sumChildren = 0,
        sumFriends = 0,
        sumBalance = 0;

    // Fill JS object "stats"
    resp.data.map( (ct) => {
      // Active
      stats.active += ct.isActive ? 1 : 0;
      // Gender
      stats.gender.male += ct.gender === 'male' ? 1 : 0;
      stats.gender.female += ct.gender === 'female' ? 1 : 0;
      // Age
      age = new Date( Date.now() - new Date(ct.birthdate) ).getFullYear() - 1970;
      stats.age.min = Math.min( age, stats.age.min );
      stats.age.max = Math.max( age, stats.age.max );
      sumAge += age;
      // Children
      stats.children.min = Math.min( ct.children.length, stats.children.min );
      stats.children.max = Math.max( ct.children.length, stats.children.max );
      sumChildren += ct.children.length;
      // Driving Licenses
      stats.drvLicenses.A += ct.drvLicenses.A ? 1 : 0;
      stats.drvLicenses.B += ct.drvLicenses.B ? 1 : 0;
      stats.drvLicenses.C += ct.drvLicenses.C ? 1 : 0;
      stats.drvLicenses.D += ct.drvLicenses.D ? 1 : 0;
      // Friends
      stats.friends.min = Math.min( ct.friends.length, stats.friends.min );
      stats.friends.max = Math.max( ct.friends.length, stats.friends.max );
      sumFriends += ct.friends.length;
      // Balance
      stats.balance.min = Math.min( ct.balance, stats.balance.min );
      stats.balance.max = Math.max( ct.balance, stats.balance.max );
      sumBalance += parseInt(ct.balance);
    });

    // Calculate averages & sums
    stats.age.avg = ( sumAge / stats.nbContacts ).toFixed(1);
    stats.children.avg = ( sumChildren / stats.nbContacts ).toFixed(1);
    stats.friends.avg = ( sumFriends / stats.nbContacts ).toFixed(1);
    stats.balance.sum = sumBalance;
    stats.balance.avg = ( sumBalance / parseInt(stats.nbContacts) ).toFixed(2);
    
    buildContactsWidgets(stats);

  });

}


function buildContactsWidgets(stats) {
    console.log('stats3', stats);

  // Build NbContacts Widget
  $('#dashContacts').text(`${stats.nbContacts}`);
  // Build Active Widget
  $('#dashActive').text(`${stats.active}`);
  $('#dashActivePct').text(`${(100 * stats.active / stats.nbContacts).toFixed(0)}%`);
  // Build Gender Widget
  $('#dashMen').text(`${stats.gender.male}`);
  $('#dashWomen').text(`${stats.gender.female}`);
  // Build Age Widget
  $('#dashAgeMax').html(`${stats.age.max}`);
  $('#dashAgeAvg').html(`${stats.age.avg}`);
  $('#dashAgeMin').html(`${stats.age.min}`);
  // Build Children Widget
  $('#dashChildren').html(`Max ${stats.children.max}<br />Avg ${stats.children.avg}<br />Min ${stats.children.min}`);
  // Build Friends Widget
  $('#dashFriends').html(`Max ${stats.friends.max}<br />Avg ${stats.friends.avg}<br />Min ${stats.friends.min}`);
  // Build Balance Widget
  $('#dashBalanceMax').html(`${new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(stats.balance.max)}`);
  $('#dashBalanceAvg').html(`${new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(stats.balance.avg)}`);
  $('#dashBalanceMin').html(`${new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(stats.balance.min)}`);
  $('#dashBalanceSum').html(`${new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(stats.balance.sum)}`);

}