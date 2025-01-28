import { Component, OnInit } from '@angular/core';
import { nurseService } from '../service/nurse.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Nurse } from '../data/nurse';
import { Router } from '@angular/router';
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrl: './login.component.css',
  providers: [nurseService]
})
export class LoginComponent {
  constructor(private nurseService: nurseService, private router: Router) { }

  // nurses: Nurse[] = jsonData;
  nurses: Array<Nurse> = [];
  login() {
    console.log(this.form.value);
    const { gmail, pwd } = this.form.value;
    let nurse = new Nurse(gmail ?? "", pwd ?? "");
    console.log(nurse);
    console.log('HOLA');

    this.nurseService.login(nurse)
      .subscribe(
        result => {
          this.nurses = result;
          //verificar si hace el login correctamente
          if (result && result.success) {
            this.router.navigate(['/getAll']);
          } else {
            console.error('Error de autenticación');
          }
        },
        error => {
          console.error('Error en la solicitud', error);
          alert('Error de autenticación');
        }
      );
  }
  get form() {
    return this.nurseService.form;
  }
}

