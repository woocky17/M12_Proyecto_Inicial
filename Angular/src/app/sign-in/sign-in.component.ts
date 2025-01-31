import { Component, OnInit } from '@angular/core';
import { nurseService } from '../service/nurse.service';
import { Nurse } from '../data/nurse';
import { FormBuilder, FormGroup, Validators, FormsModule } from '@angular/forms';
import { Nurse2 } from '../data/nurse_singup';

@Component({
  selector: 'app-sign-in',
  templateUrl: './sign-in.component.html',
  styleUrls: ['./sign-in.component.css'],
  providers: [nurseService]
})
export class SignInComponent implements OnInit {
  form: FormGroup;

  constructor(private fb: FormBuilder, private nurseService: nurseService) {
    this.form = this.fb.group({
      name: ['', Validators.required],
      gmail: ['', [Validators.required, Validators.email]],
      pwd: ['', Validators.required]
    });
  }

  ngOnInit(): void {

  }

  signUp() {
    console.log(this.form.value);
    const { name, gmail, pwd } = this.form.value as any;
    let nurse = new Nurse2(name ?? "", gmail ?? "", pwd ?? "");
    // let nurse = new Nurse2("marc", "marc@gmail.com", "1234");
    console.log(nurse);
    this.nurseService.signUp(nurse)
      .subscribe(
        result => {
          console.log(result);
          alert('Registrado correctamente');
        },
        error => {
          console.error('Error en la solicitud', error);
          alert('Error en la solicitud');
        }
      );
  }

}
