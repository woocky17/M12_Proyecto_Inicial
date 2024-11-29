import { Component } from '@angular/core';
import jsonData from '../DATA/DATA.json';
import { FormControl, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrl: './login.component.css',
})
export class LoginComponent {
nurses:Nurse[] = jsonData;

form = new FormGroup ({
gmail: new FormControl(''),
pwd: new FormControl('')
});

login (){

  console.log(jsonData);

  let value = this.form.value; 

  console.log('Form values:', value); // Muestra los valores ingresados
  console.log('Nurses array:', this.nurses); // Muestra los datos cargados

  const nurse = this.nurses.find(
    (n) =>
      n.gmail.toLowerCase() === value.gmail?.trim().toLowerCase() &&
      n.pwd === value.pwd?.trim()
  );

    if (nurse) {
      alert(`Welcome, ${nurse.name}!`);
    } else {
      alert('Invalid Gmail or Password');
    }
  }
}


class Nurse {
  id: string = '';
  name: string = '';
  pwd: string = '';
  gmail: string = '';
}
