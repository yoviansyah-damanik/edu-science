<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])
    ->group(function () {
        Route::get('/', \App\Livewire\Home\Index::class)->name('home');

        Route::get('/symlink', function () {
            $target = storage_path('app/public'); // sumber asli
            $link = public_path('storage');       // tujuan link di public/

            if (file_exists($link)) {
                return 'Symlink sudah ada.';
            }

            try {
                symlink($target, $link);
                return 'Symlink berhasil dibuat!';
            } catch (\Exception $e) {
                return 'Gagal membuat symlink: ' . $e->getMessage();
            }
        });

        Route::prefix('users-list')
            ->name('users-list.')
            ->group(function () {
                Route::get('/', \App\Livewire\UsersList\Index::class)->name('index');
            });

        Route::prefix('settings')
            ->name('settings.')
            ->group(function () {
                Route::get('/', function () {
                    return redirect()->route('settings.profile');
                })->name('index');
                Route::get('profile', \App\Livewire\Settings\Profile::class)
                    ->name('profile');
                Route::get('school-profile', \App\Livewire\Settings\SchoolProfile::class)
                    ->middleware('role:administrator')
                    ->name('school-profile');
                Route::get('password', \App\Livewire\Settings\Password::class)
                    ->name('password');
                Route::get('appearance', \App\Livewire\Settings\Appearance::class)
                    ->name('appearance');
            });

        // Khusus Administrator
        Route::middleware('role:administrator')
            ->group(function () {
                Route::get('/facilities', \App\Livewire\Facility\Index::class)
                    ->name('facilities');
                Route::get('/lesson-material-category', \App\Livewire\LessonMaterialCategory\Index::class)
                    ->name('lesson-material-category');
            });

        Route::prefix('lesson-plans')
            ->name('lesson-plans.')
            ->group(function () {
                Route::get('{semester}/{year}', \App\Livewire\LessonPlan\All::class)
                    ->middleware('role:administrator')
                    ->name('index');

                Route::get('{semester}/{year}/create', \App\Livewire\LessonPlan\Create::class)
                    ->middleware('role:teacher')
                    ->name('create');
            });

        Route::middleware('user_access')
            ->group(function () {
                Route::prefix('v/{lessonPlan:id}')
                    ->group(function () {
                        Route::get('/', \App\Livewire\LessonPlan\Index::class)
                            ->name('index');
                        Route::get('/show', \App\Livewire\LessonPlan\Show::class)
                            ->name('show');
                        Route::get('edit', \App\Livewire\LessonPlan\Edit::class)
                            ->name('edit');
                        Route::get('delete', \App\Livewire\LessonPlan\Delete::class)
                            ->name('delete');
                        Route::get('assessment', \App\Livewire\LessonPlan\Assessment::class)
                            ->name('assessment');
                        Route::get('reflection', \App\Livewire\LessonPlan\Reflection::class)
                            ->name('reflection');

                        Route::prefix('lesson-materials')
                            ->name('lesson-materials.')
                            ->group(function () {
                                Route::get('/', \App\Livewire\LessonMaterial\Index::class)
                                    ->name('index');
                                Route::get('create', \App\Livewire\LessonMaterial\Create::class)
                                    ->name('create');
                                Route::get('show/{lessonMaterial}', \App\Livewire\LessonMaterial\Show::class)
                                    ->name('show');
                                Route::get('edit/{lessonMaterial}', \App\Livewire\LessonMaterial\Edit::class)
                                    ->name('edit');
                                Route::get('delete/{lessonMaterial}', \App\Livewire\LessonMaterial\Delete::class)
                                    ->name('delete');
                            });

                        Route::prefix('lesson-activities')
                            ->name('lesson-activities.')
                            ->group(function () {
                                Route::get('/', \App\Livewire\LessonActivity\Index::class)
                                    ->name('index');
                                Route::get('{lessonMaterial}/create', \App\Livewire\LessonActivity\Create::class)
                                    ->name('create');
                                Route::get('show/{lessonActivity}', \App\Livewire\LessonActivity\Show::class)
                                    ->name('show');
                                Route::get('edit/{lessonActivity}', \App\Livewire\LessonActivity\Edit::class)
                                    ->name('edit');
                                Route::get('delete/{lessonActivity}', \App\Livewire\LessonActivity\Delete::class)
                                    ->name('delete');
                            });

                        Route::prefix('lesson-assessments')
                            ->name('lesson-assessments.')
                            ->group(function () {
                                Route::get('/', \App\Livewire\LessonAssessment\Index::class)
                                    ->name('index');
                                Route::get('{lessonMaterial}/create', \App\Livewire\LessonAssessment\Create::class)
                                    ->name('create');
                                Route::get('show/{lessonAssessment}', \App\Livewire\LessonAssessment\Show::class)
                                    ->name('show');
                                Route::get('edit/{lessonAssessment}', \App\Livewire\LessonAssessment\Edit::class)
                                    ->name('edit');
                                Route::get('delete/{lessonAssessment}', \App\Livewire\LessonAssessment\Delete::class)
                                    ->name('delete');
                            });

                        Route::prefix('student-worksheet')
                            ->name('student-worksheet.')
                            ->group(function () {
                                Route::get('/', \App\Livewire\StudentWorksheet\Index::class)
                                    ->name('index');
                                Route::get('{lessonMaterial}/create', \App\Livewire\StudentWorksheet\Create::class)
                                    ->name('create');
                                Route::get('show/{studentWorksheet}', \App\Livewire\StudentWorksheet\Show::class)
                                    ->name('show');
                                Route::get('edit/{studentWorksheet}', \App\Livewire\StudentWorksheet\Edit::class)
                                    ->name('edit');
                                Route::get('delete/{studentWorksheet}', \App\Livewire\StudentWorksheet\Delete::class)
                                    ->name('delete');
                            });

                        Route::prefix('evaluation')
                            ->name('evaluation.')
                            ->group(function () {
                                Route::get('create', \App\Livewire\Evaluation\Create::class)
                                    ->name('create');
                                Route::get('show', \App\Livewire\Evaluation\Show::class)
                                    ->name('show');
                            });
                    });
            });
    });

require __DIR__ . '/auth.php';
